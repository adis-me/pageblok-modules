<?php


namespace Pageblok\Galleries\Repositories;


use Pageblok\Core\Repositories\BaseRepository;
use Pageblok\Galleries\Interfaces\GalleryRepositoryInterface;
use Pageblok\Pageblok\Repositories\PageblokRepository;

class GalleryRepository extends BaseRepository implements GalleryRepositoryInterface
{

    /**
     * Get gallery by its name.
     *
     * @param $name
     * @return mixed
     */
    public function getByName($name)
    {
        return $this->model->where('pb_name', $name)->first();
    }
}