<?php

namespace Pageblok\Menus\Interfaces;

use Pageblok\Core\Interfaces\BaseRepositoryInterface;

interface MenuItemRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * Find menuitem(s) by the menu reference.
     *
     * @param int $id Menu id
     * @return \Illuminate\Support\Collection
     */
    public function findByMenuId($id);
} 