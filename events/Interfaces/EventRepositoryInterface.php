<?php


namespace Pageblok\Events\Interfaces;


use Pageblok\Core\Interfaces\BaseRepositoryInterface;

interface EventRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all events orderd by start date time that are published
     *
     * @return mixed
     */
    public function allPublished();
}