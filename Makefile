build-project:
	docker-compose up -d --build

tests:
	docker-compose exec php php ./vendor/bin/phpunit

infection:
	docker-compose exec php php ./vendor/bin/infection	