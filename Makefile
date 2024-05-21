env-copy:
	cp .env.example .env

#docker

docker-up:
	docker compose up -d --build --force-recreate

docker-down-v:
	docker compose down -v

docker-down:
	docker compose down

#backend

composer-install:
	docker compose run --rm php-fpm composer install

stan:
	docker compose run --rm php-fpm php vendor/bin/phpstan analyse -c phpstan.neon

cs-fixer:
	docker compose run --rm php-fpm php vendor/bin/php-cs-fixer --config=.php-cs-fixer.php fix --dry-run -vv

cs-fixer-fix:
	docker compose run --rm php-fpm php vendor/bin/php-cs-fixer --config=.php-cs-fixer.php fix -vv

#frontend

npm-install:
	docker compose run --rm node npm install

front-build:
	docker compose run --rm node npm run build

front-u-test:
	docker compose run --rm node npm run test:unit

front-linter:
	docker compose run --rm node npm run lint