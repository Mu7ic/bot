up:
	docker compose up -d
down:
	docker compose down
exec:
	@docker compose exec bot-app bash
rebuild:
	@docker compose build --no-cache
	@docker compose up --build --force-recreate --no-deps -d
refresh:
	@make down
	@make up
composer:
	@make up
	@docker compose exec bot-app composer install
migrate:
	@docker compose exec bot-app php artisan migrate
