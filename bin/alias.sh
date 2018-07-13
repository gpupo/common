#!/bin/bash

alias php-dev='docker-compose run php-dev bash'
alias php-dev-phpunit='docker-compose run php-dev vendor/bin/phpunit'
alias php-cs-fixer='docker-compose run php-dev /root/.composer/vendor/bin/php-cs-fixer'
alias phpcbf='docker-compose run php-dev /root/.composer/vendor/bin/phpcbf'
alias phpcs='docker-compose run php-dev /root/.composer/vendor/bin/phpcs'
