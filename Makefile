up:
	docker-compose up
dev:
	docker-compose up -d
	open -a Google\ Chrome http://localhost:8080
down:
	docker-compose down --remove-orphans
restart:
	@make down
	@make up
app:
	docker-compose exec php bin/bash
