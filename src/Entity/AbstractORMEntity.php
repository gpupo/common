<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gpupo\Common\Traits\PropertyAccessorsTrait;

#[ORM\MappedSuperclass]
abstract class AbstractORMEntity implements CollectionInterface
{
    use PropertyAccessorsTrait;

    #[\Override]
    public function toJson(string $route = null, int $options = 0, int $depth = 512): string
    {
        return '';
    }

    #[\Override]
    public function toLog(): array
    {
        return [];
    }

    #[\Override]
    public function toArray(): array
    {
        return [];
    }
}
