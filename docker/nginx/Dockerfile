FROM nginx:latest

RUN apt-get update \
	&& mkdir /etc/nginx/sites-available \
	&& mkdir /etc/nginx/sites-enabled

COPY config/nginx.conf /etc/nginx/
COPY config/application /etc/nginx/sites-available/

RUN ln -s /etc/nginx/sites-available/application /etc/nginx/sites-enabled/application
