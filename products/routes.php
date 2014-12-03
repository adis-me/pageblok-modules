<?php

Route::group(array('before' => 'auth'), function () {

    $backend = \Config::get('pageblok::settings.backend', '/backend' /* default is '/backend' */);

    /**
     * Products
     */
    Route::get($backend . '/products',              ['uses' => 'ProductController@index', 'as' => 'app.admin.products']);
    Route::get($backend . '/products/create',       ['uses' => 'ProductController@create', 'as' => 'app.admin.products.create']);
    Route::post($backend . '/products/create',      ['uses' => 'ProductController@save', 'as' => 'app.admin.products.save']);
    Route::get($backend . '/products/{id}/edit',    ['uses' => 'ProductController@edit', 'as' => 'app.admin.products.edit']);
    Route::post($backend . '/products/{id}/edit',   ['uses' => 'ProductController@update', 'as' => 'app.admin.products.update']);
    Route::post($backend . '/products/delete',      ['uses' => 'ProductController@delete', 'as' => 'app.admin.products.delete']);
});

