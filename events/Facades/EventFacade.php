<?php


namespace Pageblok\Events\Facades;


use Illuminate\Support\Facades\Facade;

class EventFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return "event";
    }
} 