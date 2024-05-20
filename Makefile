env-copy:
	cp .env.example .env

docker-up:
	docker compose up -d --build --force-recreate

docker-down-v:
	docker compose down -v

docker-down:
	docker compose down


npm-install:
	docker compose run --rm node npm install

front-build:
	docker compose run --rm node npm run build

front-u-test:
	docker compose run --rm node npm run test:unit

front-linter:
	docker compose run --rm node npm run lint