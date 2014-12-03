<?php


namespace Pageblok\Events\Repositories;


use Pageblok\Core\Repositories\BaseRepository;
use Pageblok\Events\Interfaces\EventRepositoryInterface;

class EventRepository extends BaseRepository implements EventRepositoryInterface
{

    /**
     * Override!
     *
     * Get all events ordered by start datetime that are published.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Pageblok\Pageblok\Interfaces\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->orderBy('start_datetime')->get();
    }

    /**
     * Get all events orderd by start date time that are published
     *
     * @return mixed
     */
    public function allPublished()
    {
        return $this->model->where('published', true)->orderBy('start_datetime')->get();
    }
}