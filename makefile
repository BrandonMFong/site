# author: Brando
# date: 4/29/25
#

DOCKER_IMAGE_NAME = site
HTTP_PORT_INTERNAL = 8081
HTTP_PORT_EXTERNAL = 8080
build:
	docker build -t "$(DOCKER_IMAGE_NAME)" .
	docker run -d --restart=always -p $(HTTP_PORT_EXTERNAL):$(HTTP_PORT_INTERNAL) "$(DOCKER_IMAGE_NAME)"

