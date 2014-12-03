<?php


namespace Pageblok\Menus\Services;


use Pageblok\Menus\Interfaces\MenuRepositoryInterface;
use Pageblok\Pageblok\Exceptions\PageblokException;

class Menu
{

    protected $repository;

    protected $bag;

    public function __construct(MenuRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $this->loadFromRepository();
    }

    public function loadFromRepository()
    {
        $this->repository->all()->each(
            function ($menu) {
                $this->bag[$menu->pb_name] = $menu;
            }
        );
    }

    /**
     * Retrieve a menu by its name.
     *
     * @param $name
     *
     * @return \Illuminate\Support\Collection|\Pageblok\Menus\Models\Menu
     * @throws PageblokException
     */
    public function get($name)
    {
        if (isset($this->bag[$name])) {
            return $this->bag[$name];
        }

        // at least return a empty menu element
        return new \Pageblok\Menus\Models\Menu();
    }
} 