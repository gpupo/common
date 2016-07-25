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

namespace Gpupo\Common\Console;

use Gpupo\Common\Traits\TableTrait;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

abstract class AbstractApplication extends Application
{
    use TableTrait;

    protected $configFiles = [];

    protected $config = [];

    protected $configAlias = [];

    protected $commonParameters = [];

    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);

        $this->findConfig(['./'], $name);
    }

    protected function addConfig($string)
    {
        $load = json_decode($string, true);
        if (!is_array($load)) {
            return false;
        }

        $this->config = array_merge($this->config, $load);

        return $this;
    }

    public function findConfig(array $paths, $nick = 'app')
    {
        foreach ($paths as $path) {
            foreach (['app.json.dist', '.'.$nick.'.json.dist', '.'.$nick.'.json', $nick.'.json',
                '.'.$nick, 'app.json', ] as $name) {
                $filename = $path.$name;
                if (file_exists($filename)) {
                    $this->configFiles[] = $filename;
                    if (false === $this->addConfig(file_get_contents($filename))) {
                        return error_log('Invalid Json format of file ['.$filename.']!');
                    }
                }
            };
        }
    }

    public function getConfig($key)
    {
        if (is_array($this->config) && array_key_exists($key, $this->config)) {
            return $this->config[$key];
        }
    }

    protected function displayConfigFiles(OutputInterface $output)
    {
        if (!empty($this->configFiles)) {
            $output->writeln('Config files loaded: <comment>'.implode('</>, <comment>', $this->configFiles).'</>');
        }
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->displayConfigFiles($output);

        return parent::doRun($input, $output);
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
        if ($input->getOption($parameter['key'])) {
            return $input->getOption($parameter['key']);
        } elseif (null !== $this->getConfig($parameter['key'])) {
            return $this->getConfig($parameter['key']);
        } elseif (is_array($parameter) && array_key_exists('options', $parameter)) {
            $subject = $parameter['key'].' (['.implode($parameter['options'], ',')
                .((array_key_exists('default', $parameter)) ? '] ENTER for <info>'
                    .$parameter['default'].'</info>' : '').'): ';

            $question = new ChoiceQuestion($subject, $parameter['options'], 0);
            $question->setErrorMessage('%s is invalid. Valid values:'.implode($parameter['options']));

            return $this->getHelperSet()->get('question')->ask($input, $output, $question);
        } else {
            $question = new Question($parameter['key'].': ');

            return  $this->getHelperSet()->get('question')->ask($input, $output, $question);
        }
    }

    public function processInputParameters(array $definitions, InputInterface $input, OutputInterface $output)
    {
        $list = [];
        foreach (array_merge($this->commonParameters, $definitions) as $parameter) {
            $list[$parameter['key']] = $this->processInputParameter($parameter, $input, $output);
        }

        return $this->processAliasParameters($list);
    }

    protected function processAliasParameters(array $list)
    {
        foreach ($this->configAlias as $k => $v) {
            if (array_key_exists($k, $list)) {
                $list[$v] = $list[$k];
            }
        }

        return $list;
    }
}
