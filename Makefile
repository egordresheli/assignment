php_apps := containers

init: init-ci
init-ci: docker-down-clear \
	docker-pull docker-build docker-up \
  	apps-init
up: docker-up
stop: docker-stop
down: docker-down
restart: down up
apps-init: apps-composer-install apps-key-generate

docker-up:
	docker-compose up -d

docker-stop:
	docker-compose stop

docker-down:
	docker-compose down

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build --pull

apps-composer-install:
	@for app in $(php_apps); do \
		docker-compose run --rm -w /apps/$$app php composer install; \
	done
	@for app in $(php81_apps); do \
		docker-compose run --rm -w /apps/$$app php81 composer install; \
	done

apps-composer-update:
	@for app in $(php_apps); do \
		docker-compose run --rm -w /apps/$$app php composer update; \
	done

apps-key-generate:
	@for app in $(php_apps); do \
		docker-compose run --rm -w /apps/$$app php php artisan key:generate; \
	done

connect-php:
	docker exec -it php sh -l

frontend-npm-install:
	docker-compose run --rm node npm install
