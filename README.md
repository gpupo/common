Common Objects for PHP components

## Requisitos para uso

* PHP >= *7.2*
* [Composer Dependency Manager](http://getcomposer.org)

Este componente **não é uma aplicação Stand Alone** e seu objetivo é ser utilizado como biblioteca.
Sua implantação deve ser feita por desenvolvedores experientes.

**Isto não é um Plugin!**

As opções que funcionam no modo de comando apenas servem para depuração em modo de
desenvolvimento.

A documentação mais importante está nos testes unitários. Se você não consegue ler os testes unitários, eu recomendo que não utilize esta biblioteca.


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

---
## Indicadores de qualidade

[![Build Status](https://secure.travis-ci.org/gpupo/common.png?branch=master)](http://travis-ci.org/gpupo/common)

---

## Instalação

Adicione o pacote ``common`` ao seu projeto utilizando [composer](http://getcomposer.org):

    composer require gpupo/common

## Uso

Criação de TestCases a partir de Classes existentes:

	vendor/bin/common tests:implement --class 'Gpupo\Common\Tools\Datetime\TimeShift'
	
