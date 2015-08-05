<?php

/*
 * This file is part of gpupo/common
 *
 * (c) Gilmar Pupo <g@g1mr.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * For more information, see
 * <http://www.g1mr.com/common/>.
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

    public function setOptions(Array $options = [])
    {
        $list = array_merge($this->getDefaultOptions(), $options);

        $this->options = new Collection($list);

        return $this;
    }

    public function receiveOptions(Collection $options)
    {
        return $this->setOptions(array_merge($this->getDefaultOptions(), $options->toArray()));
    }
}
