<?php


namespace Pageblok\Products;


use Illuminate\Support\ServiceProvider;
use Pageblok\Products\Controllers\ProductController;
use Pageblok\Products\Models\Product;
use Pageblok\Products\Repositories\ProductRepository;
use Pageblok\Products\Services\Product as ProductService;

class ProductServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'ProductRepository',
            function () {
                return new ProductRepository(new Product());
            }
        );

        $this->app->bind(
            'ProductController',
            function ($app) {
                return new ProductController(
                    $app->make('ProductRepository')
                );
            }
        );

        $this->app->singleton(
            'product',
            function () {
                return new ProductService(\App::make('ProductRepository'));
            }
        );
    }
} 