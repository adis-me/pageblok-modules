<?php

Route::group(array('before' => 'auth'), function () {

    $backend = \Config::get('pageblok::settings.backend', '/backend' /* default is '/backend' */);

    /**
     * Events
     */
    Route::get($backend . '/events',            ['uses' => 'EventController@index', 'as' => 'app.admin.events']);
    Route::get($backend . '/events/create',     ['uses' => 'EventController@create', 'as' => 'app.admin.events.create']);
    Route::post($backend . '/events/create',    ['uses' => 'EventController@save', 'as' => 'app.admin.events.save']);
    Route::get($backend . '/events/{id}/edit',  ['uses' => 'EventController@edit', 'as' => 'app.admin.events.edit']);
    Route::post($backend . '/events/{id}/edit', ['uses' => 'EventController@update', 'as' => 'app.admin.events.update']);
    Route::post($backend . '/events/delete',    ['uses' => 'EventController@delete', 'as' => 'app.admin.events.delete']);
});
