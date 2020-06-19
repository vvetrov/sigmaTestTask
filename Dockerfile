FROM php:7.4-cli
COPY . /usr/src/sigmaTestTask
WORKDIR /usr/src/sigmaTestTask
##install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer && chmod +x /usr/bin/composer
##install phpunit
RUN cd test && composer install --prefer-source --no-interaction
##generate autoload
RUN composer  dump-autoload --optimize
CMD runTests.sh