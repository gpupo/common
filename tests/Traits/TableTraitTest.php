<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Traits;

use Gpupo\Common\Entity\Collection;
use Gpupo\Common\Tests\Objects\HasTableTrait;
use Gpupo\Common\Tests\TestCaseAbstract;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\TrimmedBufferOutput;

/**
 * @coversNothing
 */
class TableTraitTest extends TestCaseAbstract
{
    public function testDisplayTableResultsFailWithEmptyTable()
    {
        $this->expectException(\Exception::class);

        (new HasTableTrait())->displayTableResults(new ConsoleOutput(), []);
    }

    public function testDisplayTableResultsFailWithString()
    {
        $this->expectException(\TypeError::class);

        (new HasTableTrait())->displayTableResults(new ConsoleOutput(), '');
    }

    public function testDisplayTableResultsSuccessWithArray()
    {
        $this->performTableTest($this->dataGenerator());
    }

    public function testDisplayTableResultsSuccessWithCollection()
    {
        $this->performTableTest(new Collection($this->dataGenerator()));
    }

    public function testDisplayTableResultsSuccessWithCollectionOfCollections()
    {
        $data = new Collection();
        foreach ($this->dataGenerator() as $row) {
            $data->add(new Collection($row));
        }

        $this->performTableTest($data);
    }

    protected function performTableTest($data): string
    {
        $output = new TrimmedBufferOutput(999);
        (new HasTableTrait())->displayTableResults($output, $data);
        $tableText = $output->fetch();
        $this->assertStringContainsString('| id | name |', $tableText);
        $this->assertStringContainsString('---- ------', $tableText);
        $this->assertStringContainsString('| dog  |', $tableText);
        $this->assertStringContainsString('| cat  |', $tableText);
        $this->assertStringContainsString('| bird |', $tableText);

        return $tableText;
    }

    protected function dataGenerator(): array
    {
        $data = [];
        foreach (['dog', 'cat', 'bird'] as $animal) {
            $data[] = [
                'id' => rand(9, 99),
                'name' => $animal,
            ];
        }

        return $data;
    }
}
