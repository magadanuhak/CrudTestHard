# Makefile for Docker

help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  cu                  Update PHP dependencies with composer"
	@echo "  cd                  Update the autoloader because of new classes in a classmap package"
	@echo "  di                  Start nginx proxy container"
	@echo "  ds                  Create and start containers"
	@echo "  docker-stop         Stop and clear all services"
	@echo "  docker-logs         Follow log output"
	@echo "  dr                  Restart"

di:
	@docker run -d -p 80:80 --restart=always -v /var/run/docker.sock:/tmp/docker.sock:ro jwilder/nginx-proxy
cu:
	@docker-compose exec php composer update

cd:
	@docker-compose exec php composer dump-autoload

ds:
	@docker-compose up -d
dr:
	@docker-compose down -v
	@docker-compose up -d

docker-stop:
	@docker-compose down -v

docker-logs:
	@docker-compose logs
