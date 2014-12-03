<?php


namespace Pageblok\Galleries\Interfaces;


use Pageblok\Core\Interfaces\BaseRepositoryInterface;

interface GalleryRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * Get gallery by its name.
     *
     * @param $name
     * @return mixed
     */
    public function getByName($name);
} 