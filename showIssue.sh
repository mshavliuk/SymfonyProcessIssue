#!/usr/bin/env bash

docker run --rm -it -v $(pwd):/usr/src/app:rw -w /usr/src/app php:7.3-cli \
    /bin/bash -c "docker-php-ext-install pcntl && \
     curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
     apt-get update && apt-get install -y git unzip && \
     composer install && php Issue.php"
