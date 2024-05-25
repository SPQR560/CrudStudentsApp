env-copy:
	cp .env.example .env

init: docker-up npm-install front-build

#docker

docker-up:
	docker compose up -d --build --force-recreate

docker-down-v:
	docker compose down -v

docker-down:
	docker compose down

#frontend

npm-install:
	docker compose run --rm node npm install

front-build:
	docker compose run --rm node npm run build

front-u-test:
	docker compose run --rm node npm run test:unit

front-linter:
	docker compose run --rm node npm run lint