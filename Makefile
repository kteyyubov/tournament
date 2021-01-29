DOCKER_COMPOSE ?= docker-compose
RUN_PHP ?= $(DOCKER_COMPOSE) run --rm --no-deps app
EXECUTE_APP ?= $(DOCKER_COMPOSE) exec app

all: up composer-install db-create db-migrate ps

# Composer
composer-install: ## [Composer] Install composer dependencies
	$(RUN_PHP) composer install
.PHONY: composer-install

# Database
db-create: ## [Database] Creates the configured database
	$(RUN_PHP) bin/console doctrine:database:create --if-not-exists
.PHONY: db-create

db-migrate: ## [Database] Execute a migration to a specified version or the latest available version
	$(RUN_PHP) bin/console doctrine:migrations:diff -n
	$(RUN_PHP) bin/console doctrine:migrations:migrate -n
.PHONY: db-migrate

db-fixtures: ## [Database] Load Fixtures
	$(RUN_PHP) bin/console doctrine:fixtures:load -q
.PHONY: db-fixtures

# Docker
up: ## [Docker] Builds, (re)creates, and start docker containers in detached mode
	$(DOCKER_COMPOSE) up --remove-orphans -d
.PHONY: up

down: ## [Docker] Stop containers and remove containers, networks, volumes, and images created by "up"
	$(DOCKER_COMPOSE) down --remove-orphans
.PHONY: down

clean: ## [Docker] Stop and remove containers
	$(DOCKER_COMPOSE) rm --force --stop
.PHONY: clean

ps: ## [Docker] List containers
	$(DOCKER_COMPOSE) ps
.PHONY: ps

logs: ## [Docker] Print logs from containers
	$(DOCKER_COMPOSE) logs -f
.PHONY: logs

ssh: ## [Docker] SSH into container
	@$(EXECUTE_APP) bash
.PHONY: ssh

help: ## Display this help message
	@cat $(MAKEFILE_LIST) | grep -e "^[a-zA-Z_\-]*: *.*## *" | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'