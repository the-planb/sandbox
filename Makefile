SHELL = bash
.ONESHELL:

--prod:
	@echo "\n\n"
	@echo "En prod, ejecutar directamente en la consola, para no dejar ficheros con info sensible"
	@echo "\n\n"

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

build/prod: --prod
	docker-compose --env-file=.env -f docker-compose.yml -f docker-compose.prod.yml build

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

restart: down up/dev

varnish/reload:
	docker-compose  exec  varnish varnishreload

varnish/purge:
	docker-compose exec varnish varnishadm 'ban req.url ~ .'

varnish/logs:
	docker-compose exec varnish varnishlog -g raw

