
## Setup environment
common@setup:
	mkdir -p Resources/statistics

## Composer Install
common@install:
	composer self-update
	COMPOSER_MEMORY_LIMIT=5G composer install --prefer-dist

## Composer Update and register packages
common@update:
	rm -f *.lock
	COMPOSER_MEMORY_LIMIT=5G composer update --no-scripts -n
	composer info > Resources/statistics/composer-packages.txt

## Clean temporary files
common@clean:
	printf "${COLOR_COMMENT}Remove temporary files${COLOR_RESET}\n"
	rm -rfv ./vendor/* ./var/* ./*.lock ./*.cache
	git checkout ./var/cache/.gitignore ./var/data/.gitignore
