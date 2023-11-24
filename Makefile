SHELL = bash
.ONESHELL:

--prod:
	@echo "\n\n"
	@echo "En prod, ejecutar directamente en la consola, para no dejar ficheros con info sensible"
	@echo "\n\n"

	cat <<-EOF > admin/.env
	NEXT_PUBLIC_ENTRYPOINT=https://www.prueba.local
	EOF

	cat <<-EOF > www/.env
	NEXT_PUBLIC_ENTRYPOINT=https://www.prueba.local
	EOF

	cat <<-EOF > .env
	IMAGES_PREFIX=jmpantoja/prueba/prod/
	SERVER_NAME=www.prueba.local
	APP_SECRET=secret
	POSTGRES_PASSWORD=secret
	POSTGRES_USER=api-platform
	POSTGRES_DB=api
	POSTGRES_VERSION=15
	CADDY_MERCURE_JWT_SECRET=api-platform
	EOF

--dev:
	cat <<-EOF > admin/.env
	NEXT_PUBLIC_ENTRYPOINT=https://www.prueba.local
	EOF

	cat <<-EOF > www/.env
	NEXT_PUBLIC_ENTRYPOINT=https://www.prueba.local
	EOF

	cat <<-EOF > .env
	IMAGES_PREFIX=jmpantoja/prueba/dev/
	SERVER_NAME=www.prueba.local
	APP_SECRET=secret
	POSTGRES_PASSWORD=secret
	POSTGRES_USER=api-platform
	POSTGRES_DB=api
	POSTGRES_VERSION=15
	CADDY_MERCURE_JWT_SECRET=api-platform
	EOF

logs/all:
	docker-compose logs -f

logs/php:
	docker-compose logs -f php

logs/admin:
	docker-compose logs -f admin

restart/all: down up/dev

restart/admin:
	docker-compose --env-file=.env restart admin

restart/php:
	docker-compose --env-file=.env restart php

build/prod: --prod
	docker-compose --env-file=.env -f docker-compose.yml -f docker-compose.prod.yml build

build/prod/admin: --prod
	docker-compose --env-file=.env -f docker-compose.yml -f docker-compose.prod.yml build admin

build/dev: --dev
	docker-compose --env-file=.env build

up/prod: --prod down
	docker-compose --env-file=.env -f docker-compose.yml -f docker-compose.prod.yml up -d --remove-orphans
	@echo "==== PROD ===="

up/dev: --dev down
	docker-compose --env-file=.env up -d --remove-orphans
	@echo "==== DEV ===="

down:
	docker-compose down --remove-orphans


varnish/reload:
	docker-compose  exec  varnish varnishreload

varnish/purge:
	docker-compose exec varnish varnishadm 'ban req.url ~ /'

varnish/logs:
	docker-compose exec varnish varnishlog -g raw

alfred/please:

	@(/mnt/workspace/the-planb/alfred/bin/entrypoint && \
			(cd admin; pnpm prettier > /dev/null ) && \
			(cd api; \
			php-cs-fixer fix --config=".php-cs-fixer.dist.php" src tests > /dev/null 2> /dev/null && \
			export YAMLFIX_NONE_REPRESENTATION="~" && \
			export export YAMLFIX_SECTION_WHITELINES="2" && \
			yamlfix config/mapping config/filters 2> /dev/null) \
  )

qa:
	(cd api; vendor/planb/planb/bin/qa src)

tests/run:
	docker-compose exec -T php bin/phpunit --no-coverage

tests/coverage:
	docker-compose exec -T -e XDEBUG_MODE=coverage php bin/phpunit -d memory_limit=512M
