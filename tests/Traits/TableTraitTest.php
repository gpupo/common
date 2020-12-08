<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://opensource.gpupo.com/>.
 *
 */

namespace Gpupo\Common\Tests\Traits;

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

    public function testDisplayTableResultsSuccessWithArray()
    {        
        $this->performTableTest($this->dataGenerator());
    }

    public function testDisplayTableResultsSuccessWithCollection()
    {
        $this->performTableTest($this->dataGenerator());
    }

    protected function performTableTest($data): void
    {
        $output = new TrimmedBufferOutput(999);
        (new HasTableTrait())->displayTableResults($output, $data);
        $this->assertStringContainsString('| dog  |', $output->fetch());   
    }
    protected function dataGenerator(): array {

        $data = [];
        foreach(['dog', 'cat', 'bird'] as $animal) {
            $data[] = [
                'id'    => rand(9, 99),
                'name'  => $animal,
            ];
        }

        return $data;
        
    }
}
