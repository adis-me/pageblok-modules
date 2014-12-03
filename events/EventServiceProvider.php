<?php


namespace Pageblok\Events;


use Illuminate\Support\ServiceProvider;
use Pageblok\Events\Controllers\EventController;
use Pageblok\Events\Repositories\EventRepository;

class EventServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'EventRepository',
            function () {
                return new EventRepository(new \Pageblok\Events\Models\Event());
            }
        );

        $this->app->bind(
            'EventController',
            function ($app) {
                return new EventController(
                    $app->make('EventRepository')
                );
            }
        );

        $this->app->singleton(
            'event',
            function () {
                return new \Pageblok\Events\Services\Event(\App::make('EventRepository'));
            }
        );
    }
}