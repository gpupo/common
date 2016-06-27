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
