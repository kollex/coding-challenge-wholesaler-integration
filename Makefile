ssh:
	@docker-compose exec ingest-service sh

fix-permissions:
	@chmod -R 777 cache

composer-install:
	@sh composer install

up:
	@docker-compose up -d

build: composer-install fix-permissions up

test:
	@docker-compose exec ingest-service /app/vendor/bin/phpunit /app/tests

ingest-data:
	@docker-compose exec ingest-service php /app/bin/console kollex:ingest-data

get-data:
	@docker-compose exec ingest-service php /app/bin/console kollex:get-data
