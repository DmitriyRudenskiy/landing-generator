<?php

$app->get('/', 'FrontController@index');

$app->group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function() use ($app)
{
    // главная
    $app->get('/', ['as' => 'admin_dashboard', 'uses' => 'DashboardController@index']);
    $app->get('/info', ['as' => 'admin_info', 'uses' => 'DashboardController@info']);

    // наши преимущества
    $app->get('/benefits', ['as' => 'admin_benefits_index', 'uses' => 'BenefitController@index']);
    $app->get('/benefits/add', ['as' => 'admin_benefits_add', 'uses' => 'BenefitController@add']);
    $app->get('/benefits/edit/{id}', ['as' => 'admin_benefits_edit', 'uses' => 'BenefitController@edit']);
    $app->post('/benefits/insert', ['as' => 'admin_benefits_insert', 'uses' => 'BenefitController@insert']);
    $app->post('/benefits/update', ['as' => 'admin_benefits_update', 'uses' => 'BenefitController@update']);
    $app->post('/benefits/remove', ['as' => 'admin_benefits_remove', 'uses' => 'BenefitController@remove']);
    $app->post('/benefits/cover', ['as' => 'admin_benefits_cover', 'uses' => 'BenefitController@cover']);
    $app->get('/benefits/hide/{id}', ['as' => 'admin_benefits_hide', 'uses' => 'BenefitController@hide']);
    $app->get('/benefits/show/{id}', ['as' => 'admin_benefits_show', 'uses' => 'BenefitController@show']);

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