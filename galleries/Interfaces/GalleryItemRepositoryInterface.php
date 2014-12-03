<?php


namespace Pageblok\Galleries\Interfaces;


use Pageblok\Core\Interfaces\BaseRepositoryInterface;

interface GalleryItemRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * Find gallery items by gallery id.
     *
     * @param $id
     * @return Illuminate\Support\Collection
     */
    public function findByGalleryId($id);
} 