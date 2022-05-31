<?php
declare(strict_types=1);

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Encore\RedisManager\Http\Middleware\Permission;
use Encore\RedisManager\Http\Middleware\Authenticate;

Route::middleware(Authenticate::class)->group(function (Router $router) {
    $router->prefix('api')->group(function (Router $router) {
        $router->get('/connections', 'RedisController@connections');

        $router->get('/info', 'RedisController@info');

        $router->get('/scan', 'RedisController@scan');

        $router->get('/key', 'RedisController@key');

        $router->middleware(Permission::class)->group(function (Router $router) {
            $router->post('/keys', 'RedisController@store');
            $router->put('/keys', 'RedisController@update');
            $router->delete('/keys', 'RedisController@destroy');
            $router->delete('/keys/item', 'RedisController@remove');

            $router->put('/expire', 'RedisController@expire');

            $router->post('/eval', 'RedisController@eval');
        });
    });

    $router->get('/{view?}', 'RedisController@index')->where('view', '(.*)');
});
