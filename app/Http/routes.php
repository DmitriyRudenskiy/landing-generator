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
    $app->get('cities', 'CityController@index');

    // получить новости в указаном короде
    $app->get('posts', 'PostController@index');

    // список компаний в городе
    $app->get('companies/{cityId}', 'CompanyController@index');

    // просмотр описания скрипта
    $app->get('company/view/{id}', 'CompanyController@view');
});

$app->group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function() use ($app)
{
    // пользователь
    $app->get('users', ['as' => 'admin_user_index', 'uses' => 'UserController@index']);
    $app->get('user/view/{id}', ['as' => 'admin_user_view', 'uses' => 'UserController@view']);
    $app->post('user/update/', ['as' => 'admin_user_update', 'uses' => 'UserController@update']);
    $app->post('user/avatar/', ['as' => 'admin_user_avatar', 'uses' => 'ImageController@avatar']);

    // посты
    $app->get('posts', ['as' => 'admin_post_index', 'uses' => 'PostController@index']);
    $app->get('posts/add', ['as' => 'admin_post_add', 'uses' => 'PostController@add']);
    $app->post('posts/insert', ['as' => 'admin_post_insert', 'uses' => 'PostController@insert']);

    // компании
    $app->get('companies', ['as' => 'admin_company_index', 'uses' => 'CompanyController@index']);
    $app->get('company/add', ['as' => 'admin_company_add', 'uses' => 'CompanyController@add']);
    $app->post('company/insert', ['as' => 'admin_company_insert', 'uses' => 'CompanyController@insert']);
    $app->get('company/view/{id}', ['as' => 'admin_company_view', 'uses' => 'CompanyController@view']);
    $app->post('company/update', ['as' => 'admin_company_update', 'uses' => 'CompanyController@update']);
    $app->get('company/hide/{id}', ['as' => 'admin_company_hide', 'uses' => 'CompanyController@hide']);

    $app->post('company/image/add', ['as' => 'admin_company_image_add', 'uses' => 'CompanyImageController@add']);
    $app->get('company/image/remove/{id}', ['as' => 'admin_company_remove', 'uses' => 'CompanyImageController@remove']);
    $app->get('company/image/cover/{id}', ['as' => 'admin_company_cover', 'uses' => 'CompanyImageController@cover']);

});