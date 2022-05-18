include .env

.PHONY: up down api

.env: ## Setup .env from dist
	cp .env.dist .env

up: .env ## Start the Docker Compose stack.
	docker-compose up -d


down: ## Stop the Docker Compose stack.
	docker-compose down

api: ## Run bash in the api service.
	docker-compose exec api bash

.PHONY: create-migrate
create-migrate: ## Create a new migration file
	docker-compose exec api bin/console doctrine:database:drop --force
	docker-compose exec api bin/console doctrine:database:create -n
	docker-compose exec api bin/console doctrine:migrations:migrate -n
	docker-compose exec api bin/console make:migration
	docker-compose exec api bin/console doctrine:migrations:migrate -n

.PHONY: test-% lint-%
test-api: ## Launch test in api
	docker-compose exec api composer yaml-lint
	docker-compose exec api composer cscheck
	docker-compose exec api composer phpstan
	docker-compose exec api composer pest

lint-api: ## Launch linter in api
	docker-compose exec api composer yaml-lint
	docker-compose exec api composer csfix
	docker-compose exec api composer cscheck

import-data: ## Create a new migration file
	docker-compose exec api bin/console app:import-data
