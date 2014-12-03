<?php

/**
 * Session routes
 */
Route::get('/register',     ['uses' => 'SessionController@register', 'as' => 'app.session.register']);
Route::post('/register',    ['uses' => 'SessionController@handleRegistration', 'as' => 'app.session.handle.registration']);
Route::get('/login',        ['uses' => 'SessionController@login', 'as' => 'app.session.login']);
Route::post('/login',       ['uses' => 'SessionController@authenticate', 'as' => 'app.session.authenticate']);
Route::get('/logout',       ['uses' => 'SessionController@logout', 'as' => 'app.session.logout']);


/**
 * Users routes
 */
Route::get('users/confirm/{code}',      ['uses' => 'UserController@confirm', 'as' => 'app.session.confirm']);
Route::get('users/forgot_password',     ['uses' => 'UserController@forgotPassword', 'as' => 'app.users.forgot.password']);
Route::post('users/forgot_password',    ['uses' => 'UserController@handleForgottenPassword', 'as' => 'app.users.handle.forgot.password']);
Route::get('users/reset_password/{token}', ['uses' => 'UserController@resetPassword', 'as' => 'app.users.reset.password']);
Route::post('users/reset_password',     ['uses' => 'UserController@handleResetPassword', 'as' => 'app.users.handle.reset.password']);

Route::group(array('before' => 'auth'), function () {

    Route::get('me/profile',    ['uses' => 'UserController@profile', 'as' => 'app.users.profile']);

    $backend = \Config::get('pageblok::settings.backend', '/backend' /* default is '/backend' */);

    /**
     * Users
     */
    Route::get($backend . '/users',             ['uses' => 'UsersController@index', 'as' => 'app.admin.users']);
    Route::get($backend . '/users/create',      ['uses' => 'UsersController@create', 'as' => 'app.admin.users.create']);
    Route::post($backend . '/users/create',     ['uses' => 'UsersController@save', 'as' => 'app.admin.users.save']);
    Route::get($backend . '/users/{id}/edit',   ['uses' => 'UsersController@edit', 'as' => 'app.admin.users.edit']);
    Route::post($backend . '/users/{id}/edit',  ['uses' => 'UsersController@update', 'as' => 'app.admin.users.update']);
    Route::post($backend . '/users/delete',     ['uses' => 'UsersController@delete', 'as' => 'app.admin.users.delete']);
});

