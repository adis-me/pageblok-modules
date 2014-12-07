<?php

Route::group(array('before' => 'auth'), function () {

    $backend = \Config::get('pageblok::settings.backend', '/backend' /* default is '/backend' */);
    $baseShopUrl = \Config::get('products::app.shop.url', /* default */ '/shop');

    /**
     * Products
     */
    Route::get($backend . '/products',              ['uses' => 'ProductController@index', 'as' => 'app.admin.products']);
    Route::get($backend . '/products/create',       ['uses' => 'ProductController@create', 'as' => 'app.admin.products.create']);
    Route::post($backend . '/products/create',      ['uses' => 'ProductController@save', 'as' => 'app.admin.products.save']);
    Route::get($backend . '/products/{id}/edit',    ['uses' => 'ProductController@edit', 'as' => 'app.admin.products.edit']);
    Route::post($backend . '/products/{id}/edit',   ['uses' => 'ProductController@update', 'as' => 'app.admin.products.update']);
    Route::post($backend . '/products/delete',      ['uses' => 'ProductController@delete', 'as' => 'app.admin.products.delete']);

    Route::get($baseShopUrl . '/cart',              ['uses' => 'CartController@index', 'as' => 'app.cart.details']);
    Route::post($baseShopUrl . '/cart/remove',      ['uses' => 'CartController@deleteFromCart', 'as' => 'app.cart.delete']);
    Route::post($baseShopUrl . '/cart/update',      ['uses' => 'CartController@updateQuantity', 'as' => 'app.cart.update']);
    Route::get($baseShopUrl . '/details/{id}',      ['uses' => 'ProductDetailsController@details', 'as' => 'app.product.details']);

    Route::post($baseShopUrl . '/details/{id}/add', ['uses' => 'ProductDetailsController@addToCart', 'as' => 'app.product.add.to.cart']);

    Route::post($baseShopUrl . '/checkout',         ['uses' => 'CheckOutController@index', 'as' => 'app.product.checkout']);

});

