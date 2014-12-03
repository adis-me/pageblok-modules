<?php


namespace Pageblok\Menus\Repositories;


use Pageblok\Core\Repositories\BaseRepository;
use Pageblok\Menus\Interfaces\MenuItemRepositoryInterface;
use Pageblok\Pageblok\Repositories\PageblokRepository;

class MenuItemRepository extends BaseRepository implements MenuItemRepositoryInterface
{
    
    public function findByMenuId($id)
    {
        return $this->model->where('menu_ref', $id)->orderBy('priority', 'ASC')->get();
    }
}