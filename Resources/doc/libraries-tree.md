## Árvore de dependências (libraries)
```
codeclimate/php-test-reporter 0.3.x-dev PHP client for reporting test coverage to Code Climate
|--ext-curl *
|--padraic/phar-updater ^1.0
|  |--padraic/humbug_get_contents ^1.0
|  |  |--composer/ca-bundle ^1.0
|  |  |  |--ext-openssl *
|  |  |  |--ext-pcre *
|  |  |  `--php ^5.3.2 || ^7.0
|  |  |--ext-openssl *
|  |  `--php ^5.3 || ^7.0 || ^7.1 || ^7.2
|  `--php >=5.3.3
|--php ^5.3 || ^7.0
|--psr/log ^1.0
|  `--php >=5.3.0
|--satooshi/php-coveralls ^1.0
|  |--ext-json *
|  |--ext-simplexml *
|  |--guzzle/guzzle ^2.8 || ^3.0
|  |  |--ext-curl *
|  |  |--php >=5.3.3
|  |  `--symfony/event-dispatcher ~2.1
|  |     `--php >=5.3.9
|  |--php ^5.3.3 || ^7.0
|  |--psr/log ^1.0
|  |  `--php >=5.3.0
|  |--symfony/config ^2.1 || ^3.0 || ^4.0
|  |  |--php ^7.1.3
|  |  `--symfony/filesystem ~3.4|~4.0
|  |     `--php ^7.1.3
|  |--symfony/console ^2.1 || ^3.0 || ^4.0
|  |  |--php ^7.1.3
|  |  `--symfony/polyfill-mbstring ~1.0
|  |     `--php >=5.3.3
|  |--symfony/stopwatch ^2.0 || ^3.0 || ^4.0
|  |  `--php ^7.1.3
|  `--symfony/yaml ^2.0 || ^3.0 || ^4.0
|     `--php ^7.1.3
`--symfony/console ^2.0 || ^3.0 || ^4.0
   |--php ^7.1.3
   `--symfony/polyfill-mbstring ~1.0
      `--php >=5.3.3
codeclimate/php-test-reporter dev-master PHP client for reporting test coverage to Code Climate
|--ext-curl *
|--padraic/phar-updater ^1.0
|  |--padraic/humbug_get_contents ^1.0
|  |  |--composer/ca-bundle ^1.0
|  |  |  |--ext-openssl *
|  |  |  |--ext-pcre *
|  |  |  `--php ^5.3.2 || ^7.0
|  |  |--ext-openssl *
|  |  `--php ^5.3 || ^7.0 || ^7.1 || ^7.2
|  `--php >=5.3.3
|--php ^5.3 || ^7.0
|--psr/log ^1.0
|  `--php >=5.3.0
|--satooshi/php-coveralls ^1.0
|  |--ext-json *
|  |--ext-simplexml *
|  |--guzzle/guzzle ^2.8 || ^3.0
|  |  |--ext-curl *
|  |  |--php >=5.3.3
|  |  `--symfony/event-dispatcher ~2.1
|  |     `--php >=5.3.9
|  |--php ^5.3.3 || ^7.0
|  |--psr/log ^1.0
|  |  `--php >=5.3.0
|  |--symfony/config ^2.1 || ^3.0 || ^4.0
|  |  |--php ^7.1.3
|  |  `--symfony/filesystem ~3.4|~4.0
|  |     `--php ^7.1.3
|  |--symfony/console ^2.1 || ^3.0 || ^4.0
|  |  |--php ^7.1.3
|  |  `--symfony/polyfill-mbstring ~1.0
|  |     `--php >=5.3.3
|  |--symfony/stopwatch ^2.0 || ^3.0 || ^4.0
|  |  `--php ^7.1.3
|  `--symfony/yaml ^2.0 || ^3.0 || ^4.0
|     `--php ^7.1.3
`--symfony/console ^2.0 || ^3.0 || ^4.0
   |--php ^7.1.3
   `--symfony/polyfill-mbstring ~1.0
      `--php >=5.3.3
phpunit/phpunit 5.7.27 The PHP Unit Testing framework.
|--ext-dom *
|--ext-json *
|--ext-libxml *
|--ext-mbstring *
|--ext-xml *
|--myclabs/deep-copy ~1.3
|  `--php ^5.6 || ^7.0
|--php ^5.6 || ^7.0
|--phpspec/prophecy ^1.6.2
|  |--doctrine/instantiator ^1.0.2
|  |  `--php ^7.1
|  |--php ^5.3|^7.0
|  |--phpdocumentor/reflection-docblock ^2.0|^3.0.2|^4.0
|  |  |--php ^7.0
|  |  |--phpdocumentor/reflection-common ^1.0.0
|  |  |  `--php >=5.5
|  |  |--phpdocumentor/type-resolver ^0.4.0
|  |  |  |--php ^5.5 || ^7.0
|  |  |  `--phpdocumentor/reflection-common ^1.0
|  |  |     `--php >=5.5
|  |  `--webmozart/assert ^1.0
|  |     `--php ^5.3.3 || ^7.0
|  |--sebastian/comparator ^1.1|^2.0
|  |  |--php >=5.3.3
|  |  |--sebastian/diff ~1.2
|  |  |  `--php ^5.3.3 || ^7.0
|  |  `--sebastian/exporter ~1.2 || ~2.0
|  |     |--php >=5.3.3
|  |     `--sebastian/recursion-context ~2.0
|  |        `--php >=5.3.3
|  `--sebastian/recursion-context ^1.0|^2.0|^3.0
|     `--php >=5.3.3
|--phpunit/php-code-coverage ^4.0.4
|  |--ext-dom *
|  |--ext-xmlwriter *
|  |--php ^5.6 || ^7.0
|  |--phpunit/php-file-iterator ^1.3
|  |  `--php >=5.3.3
|  |--phpunit/php-text-template ^1.2
|  |  `--php >=5.3.3
|  |--phpunit/php-token-stream ^1.4.2 || ^2.0
|  |  |--ext-tokenizer *
|  |  `--php ^7.0
|  |--sebastian/code-unit-reverse-lookup ^1.0
|  |  `--php ^5.6 || ^7.0
|  |--sebastian/environment ^1.3.2 || ^2.0
|  |  `--php ^5.6 || ^7.0
|  `--sebastian/version ^1.0 || ^2.0
|     `--php >=5.6
|--phpunit/php-file-iterator ~1.4
|  `--php >=5.3.3
|--phpunit/php-text-template ~1.2
|  `--php >=5.3.3
|--phpunit/php-timer ^1.0.6
|  `--php ^5.3.3 || ^7.0
|--phpunit/phpunit-mock-objects ^3.2
|  |--doctrine/instantiator ^1.0.2
|  |  `--php ^7.1
|  |--php ^5.6 || ^7.0
|  |--phpunit/php-text-template ^1.2
|  |  `--php >=5.3.3
|  `--sebastian/exporter ^1.2 || ^2.0
|     |--php >=5.3.3
|     `--sebastian/recursion-context ~2.0
|        `--php >=5.3.3
|--sebastian/comparator ^1.2.4
|  |--php >=5.3.3
|  |--sebastian/diff ~1.2
|  |  `--php ^5.3.3 || ^7.0
|  `--sebastian/exporter ~1.2 || ~2.0
|     |--php >=5.3.3
|     `--sebastian/recursion-context ~2.0
|        `--php >=5.3.3
|--sebastian/diff ^1.4.3
|  `--php ^5.3.3 || ^7.0
|--sebastian/environment ^1.3.4 || ^2.0
|  `--php ^5.6 || ^7.0
|--sebastian/exporter ~2.0
|  |--php >=5.3.3
|  `--sebastian/recursion-context ~2.0
|     `--php >=5.3.3
|--sebastian/global-state ^1.1
|  `--php >=5.3.3
|--sebastian/object-enumerator ~2.0
|  |--php >=5.6
|  `--sebastian/recursion-context ~2.0
|     `--php >=5.3.3
|--sebastian/resource-operations ~1.0
|  `--php >=5.6.0
|--sebastian/version ^1.0.6|^2.0.1
|  `--php >=5.6
`--symfony/yaml ~2.1|~3.0|~4.0
   `--php ^7.1.3

```
---
