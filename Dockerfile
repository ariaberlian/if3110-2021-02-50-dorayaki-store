FROM php:7.4-cli
RUN apt-get update && \
    apt-get install -y libxml2-dev

RUN docker-php-ext-install soap
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
# CMD [ "php", "./public/index.php" ]
