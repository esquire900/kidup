#!/bin/bash
curl -sS https://getcomposer.org/installer | php
wait $!
sudo mv composer.phar /usr/local/bin/composer

composer global require "fxp/composer-asset-plugin:1.0.3"
wait $!
composer global require "codeception/codeception=2.0.*"
composer global require "codeception/specify=*"
composer global require "codeception/verify=*"

cd /vagrant
composer install
php yii migrate/up --interactive=0
