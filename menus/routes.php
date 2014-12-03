<?php

Route::group(array('before' => 'auth'), function () {

    $backend = \Config::get('pageblok::settings.backend', '/backend' /* default is '/backend' */);

    /**
     * Menus
     */
    Route::get($backend . '/menus',                 ['uses' => 'MenuController@index', 'as' => 'app.admin.menus']);
    Route::get($backend . '/menus/create',          ['uses' => 'MenuController@create', 'as' => 'app.admin.menus.create']);
    Route::post($backend . '/menus/create',         ['uses' => 'MenuController@save', 'as' => 'app.admin.menus.save']);
    Route::get($backend . '/menus/{id}/edit',       ['uses' => 'MenuController@edit', 'as' => 'app.admin.menus.edit']);
    Route::post($backend . '/menus/{id}/edit',      ['uses' => 'MenuController@update', 'as' => 'app.admin.menus.update']);
    Route::post($backend . '/menus/delete',         ['uses' => 'MenuController@delete', 'as' => 'app.admin.menus.delete']);

    /**
     * Menu items
     */
    Route::get($backend . '/menuitems/{id}',        ['uses' => 'MenuItemController@index', 'as' => 'app.admin.menus.items']);
    Route::get($backend . '/menuitems/{id}/create', ['uses' => 'MenuItemController@create', 'as' => 'app.admin.menus.items.create']);
    Route::post($backend . '/menuitems/{id}/create',['uses' => 'MenuItemController@save', 'as' => 'app.admin.menus.items.save']);
    Route::get($backend . '/menuitems/{id}/edit',   ['uses' => 'MenuItemController@edit', 'as' => 'app.admin.menus.items.edit']);
    Route::post($backend . '/menuitems/{id}/edit',  ['uses' => 'MenuItemController@update', 'as' => 'app.admin.menus.items.update']);
    Route::post($backend . '/menuitems/{id}/delete',['uses' => 'MenuItemController@delete', 'as' => 'app.admin.menus.items.delete']);
});