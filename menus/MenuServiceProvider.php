<?php


namespace Pageblok\Menus;


use Illuminate\Support\ServiceProvider;
use Pageblok\Menus\Controllers\MenuController;
use Pageblok\Menus\Controllers\MenuItemController;
use Pageblok\Menus\Models\MenuItem;
use Pageblok\Menus\Repositories\MenuItemRepository;
use Pageblok\Menus\Repositories\MenuRepository;
use Pageblok\Menus\Services\Menu;

/**
 * Class MenuServiceProvider
 * @package Pageblok\Menus
 */
class MenuServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'MenuRepository',
            function () {
                return new MenuRepository(new \Pageblok\Menus\Models\Menu());
            }
        );

        $this->app->bind(
            'MenuItemRepository',
            function () {
                return new MenuItemRepository(new MenuItem());
            }
        );

        $this->app->bind(
            'MenuController',
            function ($app) {
                return new MenuController(
                    $app->make('MenuRepository')
                );
            }
        );

        $this->app->bind(
            'MenuItemController',
            function ($app) {
                return new MenuItemController(
                    $app->make('MenuItemRepository')
                );
            }
        );

        $this->app->singleton(
            'menu',
            function () {
                return new Menu(\App::make('MenuRepository'));
            }
        );
    }

} 