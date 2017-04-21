<?php

// для тестов
$app->get('/', function () use ($app) {
    echo route('admin_user_index');
});
$app->get('jwt', 'TestController@jwt');
$app->get('ping', 'TestController@ping');


$app->post('v1/login', 'UserController@login');

$app->group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api'], function () use ($app) {
    // список городов
    $app->get('cities', 'CityController@dashboard');

    // получить новости в указаном короде
    $app->get('posts', 'PostController@dashboard');

    // список компаний в городе
    $app->get('companies/{cityId}', 'CompanyController@dashboard');

    // просмотр описания скрипта
    $app->get('company/view/{id}', 'CompanyController@view');
});

$app->group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function() use ($app)
{
    // главная
    $app->get('/', ['as' => 'admin_dashboard', 'uses' => 'DashboardController@index']);
    $app->get('/info', ['as' => 'admin_info', 'uses' => 'DashboardController@info']);

    // наши преимущества
    $app->get('/advantage', ['as' => 'admin_advantage_index', 'uses' => 'AdvantageController@index']);
    $app->get('/advantage/add', ['as' => 'admin_advantage_add', 'uses' => 'AdvantageController@add']);
    $app->get('/advantage/edit/{id}', ['as' => 'admin_advantage_edit', 'uses' => 'AdvantageController@edit']);
    $app->post('/advantage/insert', ['as' => 'admin_advantage_insert', 'uses' => 'AdvantageController@insert']);
    $app->post('/advantage/update', ['as' => 'admin_advantage_update', 'uses' => 'AdvantageController@update']);
    $app->post('/advantage/remove', ['as' => 'admin_advantage_remove', 'uses' => 'AdvantageController@remove']);

    // заголовок
    $app->get('/header', ['as' => 'admin_header_index', 'uses' => 'HeaderController@index']);
    $app->get('/header/add', ['as' => 'admin_header_add', 'uses' => 'HeaderController@add']);
    $app->get('/header/edit/{id}', ['as' => 'admin_header_edit', 'uses' => 'HeaderController@edit']);
    $app->post('/header/insert', ['as' => 'admin_header_insert', 'uses' => 'HeaderController@insert']);
    $app->post('/header/update', ['as' => 'admin_header_update', 'uses' => 'HeaderController@update']);
    $app->post('/header/remove', ['as' => 'admin_header_remove', 'uses' => 'HeaderController@remove']);

    // товары
    $app->get('/product', ['as' => 'admin_product_index', 'uses' => 'ProductController@index']);
    $app->get('/product/add', ['as' => 'admin_product_add', 'uses' => 'ProductController@add']);
    $app->get('/product/edit/{id}', ['as' => 'admin_product_edit', 'uses' => 'ProductController@edit']);
    $app->post('/product/insert', ['as' => 'admin_product_insert', 'uses' => 'ProductController@insert']);
    $app->post('/product/update', ['as' => 'admin_product_update', 'uses' => 'ProductController@update']);
    $app->post('/product/remove', ['as' => 'admin_product_remove', 'uses' => 'ProductController@remove']);
});