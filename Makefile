DOCKER=docker-compose
PHP=docker-compose exec app php

init:
	@if [ ! -f .env ]; then cp .env.example .env; fi
	$(DOCKER) up -d --build
	echo 'Waiting DB...'
	sleep 7
	$(PHP) artisan migrate

up:
	$(DOCKER) up -d

down:
	$(DOCKER) down
