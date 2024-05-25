env-copy:
	cp .env.example .env

init: docker-up composer-install

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