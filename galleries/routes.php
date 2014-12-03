<?php

Route::group(array('before' => 'auth'), function () {

    $backend = \Config::get('pageblok::settings.backend', '/backend' /* default is '/backend' */);

    /**
     * Galleries
     */
    Route::get($backend . '/galleries',                 ['uses' => 'GalleryController@index', 'as' => 'app.admin.galleries']);
    Route::get($backend . '/galleries/create',          ['uses' => 'GalleryController@create', 'as' => 'app.admin.galleries.create']);
    Route::post($backend . '/galleries/create',         ['uses' => 'GalleryController@save', 'as' => 'app.admin.galleries.save']);
    Route::get($backend . '/galleries/{id}/edit',       ['uses' => 'GalleryController@edit', 'as' => 'app.admin.galleries.edit']);
    Route::post($backend . '/galleries/{id}/edit',      ['uses' => 'GalleryController@update', 'as' => 'app.admin.galleries.update']);
    Route::post($backend . '/galleries/delete',         ['uses' => 'GalleryController@delete', 'as' => 'app.admin.galleries.delete']);

    /**
     * Gallery items
     */
    Route::get($backend . '/galleryitems/{id}',         ['uses' => 'GalleryItemController@index', 'as' => 'app.admin.galleries.items']);
    Route::get($backend . '/galleryitems/{id}/create',  ['uses' => 'GalleryItemController@create', 'as' => 'app.admin.galleries.items.create']);
    Route::post($backend . '/galleryitems/{id}/create', ['uses' => 'GalleryItemController@save', 'as' => 'app.admin.galleries.items.save']);
    Route::get($backend . '/galleryitems/{id}/edit',    ['uses' => 'GalleryItemController@edit', 'as' => 'app.admin.galleries.items.edit']);
    Route::post($backend . '/galleryitems/{id}/edit',   ['uses' => 'GalleryItemController@update', 'as' => 'app.admin.galleries.items.update']);
    Route::post($backend . '/galleryitems/{id}/delete', ['uses' => 'GalleryItemController@delete', 'as' => 'app.admin.galleries.items.delete']);
});
 