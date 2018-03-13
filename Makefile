SHELL = /bin/sh

.PHONY: build build-update clean help test lint lint-fix test-unit test-coverage

.SILENT: help

build: ## Download the dependencies then build the image :rocket:.
	composer install

build-update: ## Update all dependencies
	composer update

# Testing

test: ## Run the unit and integration testsuites.
test: lint test-unit

lint: ## Run phpcs against the code.
	vendor/bin/phpcs -p --warning-severity=0 src/ tests/

lint-fix: ## Run phpcsf and fix possible lint errors.
	vendor/bin/phpcbf -p src/ tests/

test-unit: ## Run the unit testsuite.
	vendor/bin/phpunit --testsuite unit

test-coverage: ## Run all tests and output coverage to the console.
	vendor/bin/phpunit --coverage-text

test-coverage-html: ## Run all tests and output coverage to html.
	vendor/bin/phpunit --coverage-html=./tests/report/html

test-coverage-clover: ## Run all tests and output clover coverage to file.
	vendor/bin/phpunit --coverage-clover=./tests/report/coverage.clover

clean: ## Stop running containers and clean up an images.
	rm -rf vendor/

help: ## Show this help message.
	echo "usage: make [target] ..."
	echo ""
	echo "targets:"
	fgrep --no-filename "##" $(MAKEFILE_LIST) | fgrep --invert-match $$'\t' | sed -e 's/## / /'
