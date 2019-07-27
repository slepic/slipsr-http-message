test:
	vendor/bin/phpunit --colors=always

pre-commit: check-staged-cs test


install: git-hooks
	composer install --no-interaction

git-hooks:
	test -e .git/hooks/pre-commit || ln -s ../../.githooks/pre-commit.sh .git/hooks/pre-commit

check-cs:
	vendor/bin/php-cs-fixer fix -vvv --dry-run --ansi --config .php-cs-fixer.php src
	vendor/bin/php-cs-fixer fix -vvv --dry-run --ansi --config .php-cs-fixer.php tests

check-staged-cs:
	vendor/bin/php-cs-fixer fix -vvv --dry-run --ansi --config .php-cs-fixer.php

diff-cs:
	vendor/bin/php-cs-fixer fix -vvv --dry-run --diff --ansi --config .php-cs-fixer.php src
	vendor/bin/php-cs-fixer fix -vvv --dry-run --diff --ansi --config .php-cs-fixer.php tests

diff-staged-cs:
	vendor/bin/php-cs-fixer fix -vvv --dry-run --diff --ansi --config .php-cs-fixer.php

fix-cs:
	vendor/bin/php-cs-fixer fix -vvv --ansi --config .php-cs-fixer.php src
	vendor/bin/php-cs-fixer fix -vvv --ansi --config .php-cs-fixer.php tests

fix-staged-cs:
	vendor/bin/php-cs-fixer fix -vvv --ansi --config .php-cs-fixer.php

