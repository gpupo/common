## Run phpunit testcases
common-test@phpunit:
	APP_ENV=test ${VENDOR_BIN}/phpunit --testdox

## Run in travis execution
common-test@travis-script: install common-test@phpunit
