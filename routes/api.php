<?php

Route::post('/auth/register','Api\Auth\RegisterController@store');
Route::post('/auth/token','Api\Auth\AuthClientController@auth');

Route::group([
    'namespace' => 'Api',
    'prefix' => 'auth',
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/me','Auth\AuthClientController@me');
    Route::post('/logout','Auth\AuthClientController@logout');

    Route::post('/v1/orders/{identifyOrder}/evaluations','EvaluationApiController@store');

    Route::get('/v1/my-orders', 'OrderApiController@myOrders');
    Route::post('/v1/orders', 'OrderApiController@store');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::get('/tenants/{uuid}', 'TenantApiController@show');
    Route::get('/tenants', 'TenantApiController@index');

    Route::get('/categories/{identify}', 'CategoryApiController@show');
    Route::get('/categories', 'CategoryApiController@categoriesByTenant');

    Route::get('/tables/{identify}', 'TableApiController@show');
    Route::get('/tables', 'TableApiController@tablesByTenant');

    Route::get('/products/{identify}', 'ProductApiController@show');
    Route::get('/products', 'ProductApiController@productsByTenant');

    Route::post('/orders', 'OrderApiController@store');
    Route::get('/orders/{identify}', 'OrderApiController@show');
});