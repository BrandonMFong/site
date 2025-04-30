# author: Brando
# date: 4/29/25
#

DOCKER_IMAGE_NAME = site
DOCKER_CONTAINER_NAME = site-runner
HTTP_PORT_INTERNAL = 8081
HTTP_PORT_EXTERNAL = 8080

build:
	git submodule init && git submodule update
	cd external/http && git submodule init && git submodule update
	cd external/http && make clean dependencies build
	docker build --no-cache -t "$(DOCKER_IMAGE_NAME)" .

container: 
	docker run -d --restart=always -p $(HTTP_PORT_EXTERNAL):$(HTTP_PORT_INTERNAL) --name "$(DOCKER_CONTAINER_NAME)" "$(DOCKER_IMAGE_NAME)"

stop:
	docker container stop "$(DOCKER_CONTAINER_NAME)"

clean:
	-docker container rm "$(DOCKER_CONTAINER_NAME)"
	-docker image rm $$(docker image ls -q '$(DOCKER_IMAGE_NAME)')

