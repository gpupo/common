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

use Gpupo\Common\Entity\CollectionAbstract;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableStyle;
use Symfony\Component\Console\Output\OutputInterface;

trait TableTrait
{
    public function displayTableResults(
        OutputInterface $output,
        $object,
        array $keysOnly = [],
        $maxWidth = 35,
        $count = false
    ) {
        $table = new Table($output);
        $style = new TableStyle();
        $style->setHorizontalBorderChars('<fg=magenta>-</>')
            ->setVerticalBorderChars('<fg=magenta>|</>')
            ->setDefaultCrossingChar(' ');
        $table->setStyle($style);

        if ($object instanceof CollectionAbstract || method_exists($object, 'toArray')) {
            $list = $object->toArray();
        } else {
            $list = $object;
        }

        $i = 0;
        foreach ($list as $item) {
            if (!\is_array($item)) {
                if (method_exists($item, 'toArray')) {
                    $item = $item->toArray();
                } else {
                    continue;
                }
            }
            ++$i;
            foreach ($item as $key => $value) {
                if (!empty($keysOnly) && !\in_array($key, $keysOnly, true)) {
                    unset($item[$key]);

                    continue;
                }

                if (\is_array($value)) {
                    $value = json_encode($value);
                }
                if (\is_float($value)) {
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

                $value = mb_substr($value, 0, $maxWidth);

                $item[$key] = $value;
            }

            if (true === $count) {
                $item = array_merge(['#' => $i], $item);
            }

            if (!isset($headers)) {
                $headers = array_keys($item);
                $table->setHeaders($headers);
            }

            $table->addRow($item);
        }

        if (0 === $i) {
            throw new \Exception('Empty Table', 1);
        }

        return $table->render($output);
    }
}
