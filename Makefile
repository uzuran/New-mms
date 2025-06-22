# Makefile for Symfony + Docker
up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

rebuild:
	docker-compose down -v
	docker-compose up --build -d

bash:
	docker-compose exec php bash

composer:
	docker-compose exec php composer

symfony:
	docker-compose exec php bin/console

install:
	docker-compose run --rm php composer create-project symfony/skeleton .

logs:
	docker-compose logs -f

migrationfile:
	docker-compose exec php bin/console doctrine:migrations:diff

migrations:
	docker-compose exec php bin/console make:migration

migrate:
	docker-compose exec php bin/console doctrine:migrations:migrate

validate:
	docker-compose exec php bin/console doctrine:schema:validate

clear:
	docker-compose exec php bin/console cache:clear


seed:
	docker-compose exec php bin/console doctrine:fixtures:load

containers:
	docker ps -a

container:
	docker ps 

runcli:
	docker exec -it nuxt-app bash

celarcache:
	php bin/console cache:clear
