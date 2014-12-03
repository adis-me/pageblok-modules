<?php


namespace Pageblok\Galleries\Repositories;

use Pageblok\Core\Repositories\BaseRepository;
use Pageblok\Galleries\Interfaces\GalleryItemRepositoryInterface;
use Pageblok\Galleries\Interfaces\Illuminate;
use Pageblok\Pageblok\Repositories\PageblokRepository;

class GalleryItemRepository extends BaseRepository implements GalleryItemRepositoryInterface
{

    /**
     * Find gallery items by gallery id.
     *
     * @param $id
     * @return Illuminate\Support\Collection
     */
    public function findByGalleryId($id)
    {
        return $this->model->where('gallery_ref', $id)->paginate(15);
    }
}