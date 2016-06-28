<?php

/*
 * This file is part of gpupo/common
 * Created by Gilmar Pupo <g@g1mr.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <http://www.g1mr.com/>.
 */

namespace Gpupo\Common\Traits;

use Gpupo\Common\Entity\CollectionAbstract;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

trait TableTrait
{
    public function displayTableResults(OutputInterface $output, $object, array $keysOnly = [], $maxWidth = 35)
    {
        $table = new Table($output);
        $table->setStyle('borderless');

        if ($object instanceof CollectionAbstract) {
            $list = $object->toArray();
        } else {
            $list = $object;
        }

        foreach ($list as $item) {
            foreach ($item as $key => $value) {
                if (!empty($keysOnly) && !in_array($key, $keysOnly, true)) {
                    unset($item[$key]);

                    continue;
                }

                if (is_array($value)) {
                    $value = json_encode($value);
                }
                if (is_float($value)) {
                    $value = number_format($value, 3);
                }
                $value = str_replace(
                    ['["', '"]', '{"', '"', '}'],
                    [],
                    $value
                );

                if (empty($value)) {
                    $value = '~';
                }

                $value = substr($value, 0, $maxWidth);

                $item[$key] = $value;
            }

            if (!isset($headers)) {
                $headers = array_keys($item);
                $table->setHeaders($headers);
            }

            $table->addRow($item);
        }

        return $table->render($output);
    }
}
