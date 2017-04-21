# Запуск тестов
php vendor/bin/phpunit --bootstrap vendor/autoload.php

curl -v -X POST -d 'login=test@mail.local&password=111' "http://localhost:8000/v1/login"



$api = new \Yandex\Geo\Api();

// Можно искать по точке
$api->setPoint(30.5166187, 50.4452705);

// Или можно икать по адресу
$api->setQuery('Тверская 6');

// Настройка фильтров
$api
    ->setLimit(1) // кол-во результатов
    ->setLang(\Yandex\Geo\Api::LANG_US) // локаль ответа
    ->load();

$response = $api->getResponse();
$response->getFoundCount(); // кол-во найденных адресов
$response->getQuery(); // исходный запрос
$response->getLatitude(); // широта для исходного запроса
$response->getLongitude(); // долгота для исходного запроса

// Список найденных точек
$collection = $response->getList();
foreach ($collection as $item) {
    $item->getAddress(); // вернет адрес
    $item->getLatitude(); // широта
    $item->getLongitude(); // долгота
    $item->getData(); // необработанные данные
}


===
ALTER TABLE mobile_app.post ADD text VARCHAR(255) NULL;



http://localhost:8000/v1/cities
http://localhost:8000/v1/companies/1
http://localhost:8000/v1/company/view/1