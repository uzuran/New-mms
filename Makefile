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

migrate:
	docker-compose exec php bin/console doctrine:migrations:migrate

seed:
	docker-compose exec php bin/console doctrine:fixtures:load

containers:
	docker ps -a

container:
	docker ps 

runcli:
	docker exec -it new-mms-php-1 bash