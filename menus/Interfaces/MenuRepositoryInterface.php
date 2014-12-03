<?php


namespace Pageblok\Menus\Interfaces;


use Illuminate\Support\Collection;
use Pageblok\Core\Interfaces\BaseRepositoryInterface;

interface MenuRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * Get menu by its system name.
     *
     * @param $name
     * @return Collection
     */
    public function getByName($name);
} 