<?php


namespace Pageblok\Menus\Repositories;


use Illuminate\Support\Collection;
use Pageblok\Core\Repositories\BaseRepository;
use Pageblok\Menus\Interfaces\MenuRepositoryInterface;
use Pageblok\Pageblok\Repositories\PageblokRepository;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{

    /**
     * Get menu by its system name.
     *
     * @param $name
     * @return Collection
     */
    public function getByName($name)
    {
        return $this->model->where('pb_name', $name)->first();
    }
}