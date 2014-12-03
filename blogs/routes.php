<?php

Route::group(array('before' => 'auth'), function () {

    $backend = \Config::get('pageblok::settings.backend', '/backend' /* default is '/backend' */);

    /**
     * Page routes
     */
    Route::get($backend . '/blogs',             ['uses' => 'BlogController@index', 'as' => 'app.admin.blogs']);
    Route::get($backend . '/blogs/create',      ['uses' => 'BlogController@create', 'as' => 'app.admin.blogs.create']);
    Route::post($backend . '/blogs/create',     ['uses' => 'BlogController@save', 'as' => 'app.admin.blogs.save']);
    Route::get($backend . '/blogs/{id}/edit',   ['uses' => 'BlogController@edit', 'as' => 'app.admin.blogs.edit']);
    Route::post($backend . '/blogs/{id}/edit',  ['uses' => 'BlogController@update', 'as' => 'app.admin.blogs.update']);
    Route::post($backend . '/blogs/delete',     ['uses' => 'BlogController@delete', 'as' => 'app.admin.blogs.delete']);
});
