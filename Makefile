DOCKER=docker-compose
PHP=$(DOCKER) exec app php

init:
	@if [ ! -f .env ]; then cp .env.example .env; fi
	$(DOCKER) up -d --build
	$(PHP) artisan key:generate --ansi
	echo 'Waiting for DB...'
	sleep 7
	$(PHP) artisan migrate --ansi
