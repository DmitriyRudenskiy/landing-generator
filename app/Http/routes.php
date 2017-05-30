<?php

$app->get('/', 'FrontController@index');
$app->get('/catalog', 'FrontController@products');
$app->get('/price', 'FrontController@call');
$app->get('/leasing', 'FrontController@call');
$app->get('/bonus', 'FrontController@call');
$app->get('/delivery', 'FrontController@call');

$app->post('/need/call', 'FrontController@mail');

$app->group(['prefix' => 'JBKmibp', 'namespace' => 'App\Http\Controllers\Admin'], function() use ($app)
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

    // надписи
    $app->get('/title', ['as' => 'admin_title_index', 'uses' => 'TitleController@index']);
    $app->post('/title/update', ['as' => 'admin_title_update', 'uses' => 'TitleController@update']);

    // онлайн редактирование
    $app->get('/angular', ['as' => 'admin_angular', 'uses' => 'AngularController@index']);

    // отзывы
    $app->get('/reviews', ['as' => 'admin_reviews_index', 'uses' => 'ReviewController@index']);
    $app->get('/reviews/add', ['as' => 'admin_reviews_add', 'uses' => 'ReviewController@add']);
    $app->get('/reviews/edit/{id}', ['as' => 'admin_reviews_edit', 'uses' => 'ReviewController@edit']);
    $app->post('/reviews/insert', ['as' => 'admin_reviews_insert', 'uses' => 'ReviewController@insert']);
    $app->post('/reviews/update', ['as' => 'admin_reviews_update', 'uses' => 'ReviewController@update']);
    $app->post('/reviews/avatar', ['as' => 'admin_reviews_avatar', 'uses' => 'ReviewController@avatar']);
    $app->get('/reviews/hide/{id}', ['as' => 'admin_reviews_hide', 'uses' => 'ReviewController@hide']);
    $app->get('/reviews/show/{id}', ['as' => 'admin_reviews_show', 'uses' => 'ReviewController@show']);

    // формы
    $app->get('/form', ['as' => 'admin_form_index', 'uses' => 'FormController@index']);
    $app->get('/form/add', ['as' => 'admin_form_add', 'uses' => 'FormController@add']);
    $app->get('/form/edit/{id}', ['as' => 'admin_form_edit', 'uses' => 'FormController@edit']);
    $app->post('/form/insert', ['as' => 'admin_form_insert', 'uses' => 'FormController@insert']);
    $app->post('/form/update', ['as' => 'admin_form_update', 'uses' => 'FormController@update']);
    $app->get('/form/hide/{id}', ['as' => 'admin_form_hide', 'uses' => 'FormController@hide']);
    $app->get('/form/show/{id}', ['as' => 'admin_form_show', 'uses' => 'FormController@show']);



    // проекты
    $app->get('/projects', ['as' => 'admin_projects_index', 'uses' => 'ProjectController@index']);
    $app->post('/projects/insert', ['as' => 'admin_projects_insert', 'uses' => 'ProjectController@insert']);
    $app->post('/projects/update', ['as' => 'admin_projects_update', 'uses' => 'ProjectController@update']);
});