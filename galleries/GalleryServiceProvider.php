<?php


namespace Pageblok\Galleries;


use Illuminate\Support\ServiceProvider;
use Pageblok\Galleries\Controllers\GalleryController;
use Pageblok\Galleries\Controllers\GalleryItemController;
use Pageblok\Galleries\Repositories\GalleryItemRepository;
use Pageblok\Galleries\Repositories\GalleryRepository;

class GalleryServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'GalleryRepository',
            function () {
                return new GalleryRepository(new \Pageblok\Galleries\Models\Gallery());
            }
        );

        $this->app->bind(
            'GalleryItemRepository',
            function () {
                return new GalleryItemRepository(new \Pageblok\Galleries\Models\GalleryItem());
            }
        );

        $this->app->bind(
            'GalleryController',
            function ($app) {
                return new GalleryController(
                    $app->make('GalleryRepository')
                );
            }
        );

        $this->app->bind(
            'GalleryItemController',
            function ($app) {
                return new GalleryItemController(
                    $app->make('GalleryItemRepository')
                );
            }
        );

        $this->app->singleton(
            'gallery',
            function () {
                return new \Pageblok\Galleries\Services\Gallery(\App::make('GalleryRepository'));
            }
        );
    }
} 