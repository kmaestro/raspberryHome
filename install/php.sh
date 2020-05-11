#!/usr/bin/env zsh
sudo apt update -y && sudo apt upgrade -y

sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
echo "deb https://packages.sury.org/php/ buster main" | sudo tee /etc/apt/sources.list.d/php.list
sudo apt-get update
sudo apt-get install -y php7.4-common php7.4-fpm php7.4-cli php7.4-curl php7.4-json php7.4-mysql php7.4-opcache php7.4-gd php7.4-sqlite3 php7.4-mbstring php7.4-zip php7.4-readline php-pear nginx
sudo apt-get purge apache2 -y
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer