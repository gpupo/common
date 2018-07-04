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
