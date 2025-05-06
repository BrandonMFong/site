# site

This repository contains the source code for my personal portfolio website. It includes all the necessary HTML, source code, and Docker configuration to easily host the website using a container. Additionally, it features a custom HTTP server program I wrote in C++ to serve the website content.

## Key Features

* **Portfolio Website:** Contains all the HTML, CSS, and JavaScript files for my personal portfolio.  
* **[Custom HTTP Server](https://github.com/BrandonMFong/http):** Includes a lightweight HTTP server program written in C++ to serve the website content.  
* **Dockerized:** Provides a Dockerfile and related configuration to build a Docker image for easy deployment.  
* **Containerized Hosting:** Allows for simple deployment of the website in a Docker container.

## Installation Instructions

To build the Docker image and run the container, execute the following command in the root of the repository:

`make build container`

This command will:

1. Build the http server command line tool.
2. Build the Docker image for the website.
4. Run a Docker container based on the built image, exposing the website on port 8080.

**Prerequisites:**

* Docker installed on your system.  
* make utility available on your system.

## **Usage Instructions**

Once the Docker container is running, you can access the portfolio website by navigating to the following URL in your web browser:  
[http://127.0.0.1:8080](http://127.0.0.1:8080)

The website should now be accessible, served by the custom HTTP server running inside the Docker container.

## **Technologies Used**

* **C++:** For the custom HTTP server program.  
* **Docker:** For containerization and deployment.  
* **HTML:** For the structure of the website.  
* **CSS:** For the styling of the website.
