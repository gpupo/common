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

namespace Gpupo\Common\Console;

use Exception;
use Gpupo\Common\Traits\TableTrait;
use Monolog\Logger;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

abstract class AbstractApplication extends Application
{
    use TableTrait;

    protected $configAlias = [
        'env' => 'version',
    ];

    protected $commonParameters = [];

    protected function define(string $name, $value): void
    {
        if (!\defined($name)) {
            \define($name, $value);
        }
    }

    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        $this->define('NAMESPACE_SEPARATOR', '\\');

        parent::__construct($name, $version);
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        return parent::doRun($input, $output);
    }

    /**
     * @deprecated since 4.6
     */
    public function factoryDefinition(array $definitions = [])
    {
        $list = [];

        foreach (array_merge($this->commonParameters, $definitions) as $parameter) {
            $list[] = new InputOption($parameter['key'], null, InputOption::VALUE_REQUIRED);
        }

        return $list;
    }

    /**
     * @deprecated since 4.6
     */
    public function processInputParameters(array $definitions, InputInterface $input, OutputInterface $output)
    {
        $list = [];
        foreach (array_merge($this->commonParameters, $definitions) as $parameter) {
            $list[$parameter['key']] = $this->processInputParameter($parameter, $input, $output);
        }

        return $this->processAliasParameters($list);
    }

    /**
     * @deprecated since 4.6
     *
     * @param mixed $name
     * @param mixed $description
     */
    public function appendCommand($name, $description, array $definition = [])
    {
        return $this->register($name)
            ->setDescription($description)
            ->setDefinition($this->factoryDefinition($definition));
    }

    public function showException(Exception $e, OutputInterface $output, $description = 'Erro')
    {
        $output->writeln('<error>'.$description.'</error>');
        $output->writeln('Message: <comment>'.$e->getMessage().'</comment>');
        $output->writeln('Error Code: <comment>'.$e->getCode().'</comment>');
    }

    /**
     * @deprecated since 4.6. Use ResourceTrait instead
     *
     * @param mixed $filename
     */
    public function jsonLoadFromFile($filename)
    {
        if (!file_exists($filename)) {
            throw new Exception('Filename '.$filename.' not exists!');
        }

        $string = file_get_contents($filename);

        return json_decode($string, true);
    }

    public function jsonSaveToFile(array $array, $filename, OutputInterface $output): void
    {
        $json = json_encode($array, JSON_PRETTY_PRINT);
        file_put_contents($filename, $json);

        $output->writeln('Arquivo <info>'.$filename.'</info> gerado.');
    }

    /**
     * @deprecated since 4.6
     *
     * @param mixed $parameter
     */
    protected function processInputParameter($parameter, InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption($parameter['key'])) {
            return $input->getOption($parameter['key']);
        }

        $envValue = getenv($parameter['key']);
        if (null !== $envValue) {
            return $envValue;
        }

        if (\is_array($parameter) && array_key_exists('options', $parameter)) {
            $subject = $parameter['key'].' (['.implode(',', $parameter['options']).((array_key_exists('default', $parameter)) ? '] ENTER for <info>'.$parameter['default'].'</info>' : '').'): ';

            $question = new ChoiceQuestion($subject, $parameter['options'], 0);
            $question->setErrorMessage('%s is invalid. Valid values:'.implode('', $parameter['options']));

            return $this->getHelperSet()->get('question')->ask($input, $output, $question);
        }
        $question = new Question($parameter['key'].': ');

        return  $this->getHelperSet()->get('question')->ask($input, $output, $question);
    }

    /**
     * @deprecated since 4.6
     */
    protected function processAliasParameters(array $list): array
    {
        foreach ($this->configAlias as $k => $v) {
            if (array_key_exists($k, $list)) {
                $list[$v] = $list[$k];
            }
        }

        return $list;
    }

    protected function getLogFilePath(): string
    {
        return 'var/logs/main.log';
    }

    protected function getLogLevel(): int
    {
        return ('true' === getenv('APP_DEBUG')) ? Logger::DEBUG : Logger::INFO;
    }
}
