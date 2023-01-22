<?php

use App\Admin\Controllers\MessagesController;
use App\Admin\Controllers\QuestionsController;
use App\Admin\Controllers\TelegramUsersController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('questions', QuestionsController::class);
    $router->resource('telegram-users', TelegramUsersController::class);
    $router->resource('messages', MessagesController::class);
});
