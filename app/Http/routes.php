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
    $app->post('/benefits/cover', ['as' => 'admin_benefits_cover', 'uses' => 'BenefitController@cover']);
    $app->get('/benefits/hide/{id}', ['as' => 'admin_benefits_hide', 'uses' => 'BenefitController@hide']);
    $app->get('/benefits/show/{id}', ['as' => 'admin_benefits_show', 'uses' => 'BenefitController@show']);

    // заголовок
    $app->get('/header', ['as' => 'admin_header_index', 'uses' => 'HeaderController@index']);
    $app->get('/header/add', ['as' => 'admin_header_add', 'uses' => 'HeaderController@add']);
    $app->get('/header/edit/{id}', ['as' => 'admin_header_edit', 'uses' => 'HeaderController@edit']);
    $app->post('/header/insert', ['as' => 'admin_header_insert', 'uses' => 'HeaderController@insert']);
    $app->post('/header/update', ['as' => 'admin_header_update', 'uses' => 'HeaderController@update']);
    $app->post('/header/bg', ['as' => 'admin_header_bg', 'uses' => 'HeaderController@bg']);
    $app->get('/header/show/{id}', ['as' => 'admin_header_show', 'uses' => 'HeaderController@show']);

    // товары
    $app->get('/product', ['as' => 'admin_product_index', 'uses' => 'ProductController@index']);
    $app->get('/product/add', ['as' => 'admin_product_add', 'uses' => 'ProductController@add']);
    $app->get('/product/edit/{id}', ['as' => 'admin_product_edit', 'uses' => 'ProductController@edit']);
    $app->post('/product/insert', ['as' => 'admin_product_insert', 'uses' => 'ProductController@insert']);
    $app->post('/product/update', ['as' => 'admin_product_update', 'uses' => 'ProductController@update']);
    $app->post('/product/photo', ['as' => 'admin_product_photo', 'uses' => 'ProductController@photo']);
    $app->get('/product/hide/{id}', ['as' => 'admin_product_hide', 'uses' => 'ProductController@hide']);
    $app->get('/product/show/{id}', ['as' => 'admin_product_show', 'uses' => 'ProductController@show']);

    // надписи для товаров
    $app->get('/product/label', ['as' => 'admin_label_index', 'uses' => 'LabelController@index']);
    $app->get('/product/label/edit/{id}', ['as' => 'admin_label_edit', 'uses' => 'LabelController@edit']);
    $app->post('/product/label/update', ['as' => 'admin_label_update', 'uses' => 'LabelController@update']);
    $app->get('/product/label/hide/{id}', ['as' => 'admin_label_hide', 'uses' => 'LabelController@hide']);
    $app->get('/product/label/show/{id}', ['as' => 'admin_label_show', 'uses' => 'LabelController@show']);

    // меню ландига
    $app->get('/menu', ['as' => 'admin_menu_index', 'uses' => 'MenuController@index']);
    $app->post('/menu/insert', ['as' => 'admin_menu_insert', 'uses' => 'MenuController@insert']);
    $app->post('/menu/update', ['as' => 'admin_menu_update', 'uses' => 'MenuController@update']);
    $app->post('/menu/logo', ['as' => 'admin_menu_logo', 'uses' => 'MenuController@logo']);
    $app->post('/menu/phone', ['as' => 'admin_menu_phone', 'uses' => 'MenuController@phone']);
    $app->get('/menu/remove/{id}', ['as' => 'admin_menu_remove', 'uses' => 'MenuController@remove']);

    // онлайн редактирование
    $app->get('/angular', ['as' => 'admin_angular', 'uses' => 'AngularController@index']);
});