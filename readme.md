# Запуск серверов
nano /etc/rc.local
php -S 0.0.0.0:8083 -t /php/fuso-canter.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:8085 -t /php/hyundai-d78.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:8087 -t /php/hino-300.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:8089 -t /php/iveko-daily.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:8091 -t /php/isuzu-elf.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:8093 -t /php/isuzu.market/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:8095 -t /php/tbm.su/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:8097 -t /php/baa.tbm.su/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:8099 -t /php/kar.tbm.su/public_html/ > /dev/null 2>&1 &

http://fuso-canter.ru:8083
http://hyundai-d78.ru:8085
http://hino-300.ru:8087
http://iveko-daily.ru:8089
http://isuzu-elf.ru:8091

# Запуск тестов
php vendor/bin/phpunit --bootstrap vendor/autoload.php

echo 'Start: baa.tbm.su'
cd /php/baa.tbm.su
git pull
composer install
php artisan migrate

echo 'Start: kar.tbm.su'
cd /php/kar.tbm.su
git pull
composer install
php artisan migrate