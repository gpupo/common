<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/common created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file LICENSE which is
 * distributed with this source code. For more information, see <https://opensource.gpupo.com/>
 */

namespace Gpupo\Common\Traits;

use Gpupo\Common\Entity\Collection;

trait OptionsTrait
{
    protected $options = [];

    public function getOptions()
    {
        if (!$this->options instanceof Collection) {
            $this->setOptions($this->options);
        }

        return $this->options;
    }

    public function getDefaultOptions()
    {
        return [];
    }

    public function setOptions(array $options = [])
    {
        $list = array_merge($this->getDefaultOptions(), $options);

        $this->options = new Collection($list);

        return $this;
    }

    public function receiveOptions(Collection $options)
    {
        return $this->setOptions($options->toArray());
    }
}
