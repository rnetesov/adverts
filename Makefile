docker-up:
	docker-compose up -d
docker-down:
	docker-compose down
docker-build:
	docker-compose up --build -d
test:
	docker-compose exec php-cli vendor/bin/phpunit --colors=always
asset-run:
	docker-compose exec nodejs npm run prod