<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Tests\Objects;

use Gpupo\Common\Interfaces\OptionsInterface;
use Gpupo\Common\Traits\OptionsTrait;

class HasOptions extends AbstractObject implements OptionsInterface
{
    use OptionsTrait;

    public function getDefaultOptions()
    {
        return [
            'king' => 'james',
            'queen' => 'margaret',
        ];
    }
}
