<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('pages', PageController::class);
    $router->resource('sub_pages', SubPageController::class)->middleware('set_page');
    $router->resource('page_blocks', PageBlockController::class)->middleware('set_page');
    $router->resource('mailforms', MailFormController::class)->middleware('set_page_block');
    $router->resource('mailform_fields', MailFormFieldController::class)->middleware('set_mailform');
    $router->get('remove_photo', 'PageBlockController@removePhoto');
    $router->resource('goods', GoodController::class);


});
