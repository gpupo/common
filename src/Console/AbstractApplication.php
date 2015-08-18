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

namespace Gpupo\Common\Console;

use InvalidArgumentException;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractApplication extends Application
{
    protected $config = [];

    protected $commonParameters = [];

    protected function addConfig($string)
    {
        $this->config = array_merge($this->config, @json_decode($string, true));

        return $this;
    }

    public function findConfig(array $paths, $nick = 'app')
    {
        foreach ($paths as $path) {
            foreach ([$nick.'.json.dist', $nick.'.json', '.'.$nick] as $name) {
                $filename = $path.$name;
                if (file_exists($filename)) {
                    $this->addConfig(file_get_contents($filename));
                }
            };
        }
    }

    public function factoryDefinition(array $definitions = [])
    {
        $list = [];

        foreach (array_merge($this->commonParameters, $definitions) as $parameter) {
            $list[] = new InputOption($parameter['key'], null, InputOption::VALUE_REQUIRED);
        }

        return $list;
    }

    protected function processInputParameter($parameter, InputInterface $input, OutputInterface $output)
    {
        if (array_key_exists($parameter['key'], $this->config)) {
            return $this->config[$parameter['key']];
        } elseif ($input->getOption($parameter['key'])) {
            return $input->getOption($parameter['key']);
        } elseif (array_key_exists('options', $parameter)) {
            $subject = $parameter['key'].' (['.implode($parameter['options'], ',')
                .((array_key_exists('default', $parameter)) ? '] ENTER for <info>'.$parameter['default'].'</info>' : '').'): ';

            return $this->getHelperSet()->get('dialog')->askAndValidate($output, $subject, function ($value) use ($parameter) {
               if (array_search($value, $parameter['options'], true) === false) {
                   throw new InvalidArgumentException(sprintf($parameter['key'].'"%s" is invalid. Valid values:'.implode($parameter['options'], ','), $value));
               }

               return $value;
           }, false, (array_key_exists('default', $parameter) ? $parameter['default'] : ''));
        } else {
            return  $this->getHelperSet()->get('dialog')->ask($output, $parameter['key'].': ');
        }
    }

    public function processInputParameters(array $definitions, InputInterface $input, OutputInterface $output)
    {
        $list = [];
        foreach (array_merge($this->commonParameters, $definitions) as $parameter) {
            $list[$parameter['key']] = $this->processInputParameter($parameter, $input, $output);
        }

        return $list;
    }
}
