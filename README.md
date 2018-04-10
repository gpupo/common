
<!-- main -->

# common

Common Objects for PHP components

<!-- require -->

## Requisitos para uso

* PHP >= *5.6*
* [curl extension](http://php.net/manual/en/intro.curl.php)
* [Composer Dependency Manager](http://getcomposer.org)

Este componente **não é uma aplicação Stand Alone** e seu objetivo é ser utilizado como biblioteca.
Sua implantação deve ser feita por desenvolvedores experientes.

**Isto não é um Plugin!**

As opções que funcionam no modo de comando apenas servem para depuração em modo de
desenvolvimento.

A documentação mais importante está nos testes unitários. Se você não consegue ler os testes unitários, eu recomendo que não utilize esta biblioteca.

<!-- license -->

## Direitos autorais e de licença

Este componente está sob a [licença MIT](https://github.com/gpupo/common-sdk/blob/master/LICENSE)

Para a informação dos direitos autorais e de licença você deve ler o arquivo
de [licença](https://github.com/gpupo/common-sdk/blob/master/LICENSE) que é distribuído com este código-fonte.

### Resumo da licença

Exigido:

- Aviso de licença e direitos autorais

Permitido:

- Uso comercial
- Modificação
- Distribuição
- Sublicenciamento

Proibido:

- Responsabilidade Assegurada

<!-- QA -->

## Indicadores de qualidade

[![Build Status](https://secure.travis-ci.org/gpupo/common.png?branch=master)](http://travis-ci.org/gpupo/common)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gpupo/common/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gpupo/common/?branch=master)
[![Code Climate](https://codeclimate.com/github/gpupo/common/badges/gpa.svg)](https://codeclimate.com/github/gpupo/common)
[![Code Coverage](https://scrutinizer-ci.com/g/gpupo/common/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/gpupo/common/?branch=master)
[![Test Coverage](https://codeclimate.com/github/gpupo/common/badges/coverage.svg)](https://codeclimate.com/github/gpupo/common/coverage)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c74618a2-45c9-4d12-922a-704b23f7c607/mini.png)](https://insight.sensiolabs.com/projects/c74618a2-45c9-4d12-922a-704b23f7c607)

<!-- thanks -->


<!-- install -->

---

## Instalação

Adicione o pacote ``common`` ao seu projeto utilizando [composer](http://getcomposer.org):

    composer require gpupo/common

<!-- console -->


<!-- links -->


<!-- links-common -->


<!-- dev -->


<!-- todo -->


<!-- dev-common -->


---

## Propriedades dos objetos

<!-- testdox -->

### Common\Entity\ArrayCollection


- [x] To array indexed
- [x] To array associative
- [x] To array mixed
- [x] First indexed
- [x] First associative
- [x] First mixed
- [x] Last indexed
- [x] Last associative
- [x] Last mixed
- [x] Key indexed
- [x] Key associative
- [x] Key mixed
- [x] Next indexed
- [x] Next associative
- [x] Next mixed
- [x] Current indexed
- [x] Current associative
- [x] Current mixed
- [x] Get keys indexed
- [x] Get keys associative
- [x] Get keys mixed
- [x] Get values indexed
- [x] Get values associative
- [x] Get values mixed
- [x] Count indexed
- [x] Count associative
- [x] Count mixed
- [x] Remove
- [x] Remove element
- [x] Contains key
- [x] Empty
- [x] Contains
- [x] Exists
- [x] Index of
- [x] Get

### Common\Entity\Collection


- [x] Possui acesso singleton
- [x] Possui métodos getters e setters mágicos
- [x] Métodos getters mágicos possibilitam acesso a propriedades camel case ou snake case
- [x] Possui estrutura de informacao 
- [x] To array indexed
- [x] To array associative
- [x] To array mixed
- [x] First indexed
- [x] First associative
- [x] First mixed
- [x] Last indexed
- [x] Last associative
- [x] Last mixed
- [x] Key indexed
- [x] Key associative
- [x] Key mixed
- [x] Next indexed
- [x] Next associative
- [x] Next mixed
- [x] Current indexed
- [x] Current associative
- [x] Current mixed
- [x] Get keys indexed
- [x] Get keys associative
- [x] Get keys mixed
- [x] Get values indexed
- [x] Get values associative
- [x] Get values mixed
- [x] Count indexed
- [x] Count associative
- [x] Count mixed
- [x] Remove
- [x] Remove element
- [x] Contains key
- [x] Empty
- [x] Contains
- [x] Exists
- [x] Index of
- [x] Get

Tools\Datetime\Holidays
- [x] ``listOfHolidays()`` 
- [x] ``isHoliday()`` 

### Common\Tools\StringTool


- [x] Converte camel case para snake case 

### Common\Traits\GettersTypeTrait


- [x] Get type float
- [x] Get type boolean

### Common\Traits\LoggerAwareTrait


- [x] Implements logger interface

### Common\Traits\MagicCallTrait


- [x] Has magic methods

### Common\Traits\OptionsTrait


- [x] Implements options interface
- [x] Has options container

### Common\Traits\SingletonTrait


- [x] Has singleton instance access


<!-- libraries-table -->


## Lista de dependências (libraries)

Name | Version | Description
-----|---------|------------------------------------------------------
codeclimate/php-test-reporter | dev-master 4eac73d PHP client for reporting test coverage to Code Climate
doctrine/instantiator | 1.0.5 | A small, lightweight utility to instantiate objects in PHP without invoking their constructors
guzzle/guzzle | v3.9.3 | PHP HTTP client. This library is deprecated in favor of https://packagist.org/packages/guzzlehttp/guzzle
myclabs/deep-copy | 1.6.1 | Create deep copies (clones) of your objects
padraic/humbug_get_contents | 1.0.4 | Secure wrapper for accessing HTTPS resources with file_get_contents for PHP 5.3+
padraic/phar-updater | 1.0.3 | A thing to make PHAR self-updating easy and secure.
phpdocumentor/reflection-common | 1.0 | Common reflection classes used by phpdocumentor to reflect the code structure
phpdocumentor/reflection-docblock | 3.1.1 | With this component, a library can provide support for annotations via DocBlocks or otherwise retrieve information that is embedded in a DocBlock.
phpdocumentor/type-resolver | 0.2.1 | 
phpspec/prophecy | v1.7.0 | Highly opinionated mocking framework for PHP 5.3+
phpunit/php-code-coverage | 4.0.8 | Library that provides collection, processing, and rendering functionality for PHP code coverage information.
phpunit/php-file-iterator | 1.4.2 | FilterIterator implementation that filters files based on a list of suffixes.
phpunit/php-text-template | 1.2.1 | Simple template engine.
phpunit/php-timer | 1.0.9 | Utility class for timing
phpunit/php-token-stream | 1.4.11 | Wrapper around PHP's tokenizer extension.
phpunit/phpunit | 5.7.20 | The PHP Unit Testing framework.
phpunit/phpunit-mock-objects | 3.4.3 | Mock Object library for PHPUnit
psr/log | 1.0.2 | Common interface for logging libraries
satooshi/php-coveralls | v1.0.1 | PHP client library for Coveralls API
sebastian/code-unit-reverse-lookup 1.0.1 | Looks up which function or method a line of code belongs to
sebastian/comparator | 1.2.4 | Provides the functionality to compare PHP values for equality
sebastian/diff | 1.4.3 | Diff implementation
sebastian/environment | 2.0.0 | Provides functionality to handle HHVM/PHP environments
sebastian/exporter | 2.0.0 | Provides the functionality to export PHP variables for visualization
sebastian/global-state | 1.1.1 | Snapshotting of global state
sebastian/object-enumerator | 2.0.1 | Traverses array structures and object graphs to enumerate all referenced objects
sebastian/recursion-context | 2.0.0 | Provides functionality to recursively process PHP variables
sebastian/resource-operations | 1.0.0 | Provides a list of PHP built-in functions that operate on resources
sebastian/version | 2.0.1 | Library that helps with managing the version number of Git-hosted PHP projects
symfony/config | v3.2.8 | Symfony Config Component
symfony/console | v3.2.8 | Symfony Console Component
symfony/debug | v3.2.8 | Symfony Debug Component
symfony/event-dispatcher | v2.8.20 | Symfony EventDispatcher Component
symfony/filesystem | v3.2.8 | Symfony Filesystem Component
symfony/polyfill-mbstring | v1.3.0 | Symfony polyfill for the Mbstring extension
symfony/stopwatch | v3.2.8 | Symfony Stopwatch Component
symfony/yaml | v3.2.8 | Symfony Yaml Component
webmozart/assert | 1.2.0 | Assertions to validate method input/output with nice error messages.



<!-- footer-common -->


