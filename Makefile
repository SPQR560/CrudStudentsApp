env-copy:
	cp .env.example .env

docker-up:
	docker compose up -d --build --force-recreate

docker-down-v:
	docker compose down -v

docker-down:
	docker compose down