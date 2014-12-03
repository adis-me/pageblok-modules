<?php


namespace Pageblok\Galleries\Services;


use Pageblok\Galleries\Interfaces\GalleryRepositoryInterface;

class Gallery
{

    protected $repository;

    public function __construct(GalleryRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $this->loadFromRepository();
    }

    /**
     * Load galleries from repository;
     */
    public function loadFromRepository()
    {
        $this->repository->all()->each(
            function ($gallery) {
                $this->bag[$gallery->pb_name] = $gallery;
            }
        );
    }

    /**
     * Get gallery by name
     *
     * @param null $name
     *
     * @return \Pageblok\Galleries\Models\Gallery
     */
    public function get($name = null)
    {
        if (isset($this->bag[$name])) {
            return $this->bag[$name];
        }

        return new \Pageblok\Galleries\Models\Gallery();
    }

} 