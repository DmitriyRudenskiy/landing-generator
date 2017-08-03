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

php -S 0.0.0.0:10026 -t /php/cuba-club.ru/root/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10096 -t /php/cuba-club.ru/a.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10097 -t /php/cuba-club.ru/b.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10037 -t /php/cuba-club.ru/c.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10012 -t /php/cuba-club.ru/d.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10042 -t /php/cuba-club.ru/e.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10058 -t /php/cuba-club.ru/f.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10040 -t /php/cuba-club.ru/g.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10088 -t /php/cuba-club.ru/h.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10092 -t /php/cuba-club.ru/i.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10045 -t /php/cuba-club.ru/j.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10088 -t /php/cuba-club.ru/k.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10079 -t /php/cuba-club.ru/l.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10030 -t /php/cuba-club.ru/m.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10042 -t /php/cuba-club.ru/n.cuba-club.ru/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:10024 -t /php/cuba-club.ru/o.cuba-club.ru/public_html/ > /dev/null 2>&1 &

php -S 0.0.0.0:11001 -t /php/samosval.store/public_html/ > /dev/null 2>&1 &


php -S 0.0.0.0:20001 -t /php/atorgi.ru/auto/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:20003 -t /php/atorgi.ru/parts/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:20005 -t /php/atorgi.ru/service/public_html/ > /dev/null 2>&1 &
php -S 0.0.0.0:20007 -t /php/atorgi.ru/tires/public_html/ > /dev/null 2>&1 &

php -S 0.0.0.0:50001 -t /php/isuzu-project-parser/public/ > /dev/null 2>&1 &

php -S 0.0.0.0:50001 -t

php -S 0.0.0.0:50001 -t /php/isuzu-project-parser/public/ > /dev/null 2>&1 &



    backend cubaclubru_backend
        server node1 127.0.0.1:10026

    backend acubaclubru_backend
        server node1 127.0.0.1:10096

    backend bcubaclubru_backend
        server node1 127.0.0.1:10097

    backend ccubaclubru_backend
        server node1 127.0.0.1:10037

    backend dcubaclubru_backend
        server node1 127.0.0.1:10012

    backend ecubaclubru_backend
        server node1 127.0.0.1:10042

    backend fcubaclubru_backend
        server node1 127.0.0.1:10058

    backend gcubaclubru_backend
        server node1 127.0.0.1:10040

    backend hcubaclubru_backend
        server node1 127.0.0.1:10088

    backend icubaclubru_backend
        server node1 127.0.0.1:10092

    backend jcubaclubru_backend
        server node1 127.0.0.1:10045

    backend kcubaclubru_backend
        server node1 127.0.0.1:10088

    backend lcubaclubru_backend
        server node1 127.0.0.1:10079

    backend mcubaclubru_backend
        server node1 127.0.0.1:10030

    backend ncubaclubru_backend
        server node1 127.0.0.1:10042

    backend ocubaclubru_backend
        server node1 127.0.0.1:10024

    backend newcubaru_backend
        server node1 127.0.0.1:30001



http://fuso-canter.ru:8083
http://hyundai-d78.ru:8085
http://hino-300.ru:8087
http://iveko-daily.ru:8089
http://isuzu-elf.ru:8091

# Запуск тестов
php vendor/bin/phpunit --bootstrap vendor/autoload.php
