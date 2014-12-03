<?php

namespace Pageblok\Users;


use Illuminate\Support\ServiceProvider;
use Pageblok\Users\Controllers\SessionController;
use Pageblok\Users\Controllers\UserController;
use Pageblok\Users\Controllers\UsersController;
use Pageblok\Users\Repositories\UserRepository;

class UserServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'UserRepository',
            function () {
                return new UserRepository(new \Pageblok\Users\Models\User());
            }
        );

        $this->app->bind(
            'SessionController',
            function ($app) {
                return new SessionController(
                    $app->make('UserRepository')
                );
            }
        );

        $this->app->bind(
            'UserController',
            function ($app) {
                return new UserController(
                    $app->make('UserRepository')
                );
            }
        );

        $this->app->bind(
            'UsersController',
            function ($app) {
                return new UsersController(
                    $app->make('UserRepository')
                );
            }
        );

    }
} 