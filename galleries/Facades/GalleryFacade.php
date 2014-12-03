<?php


namespace Pageblok\Galleries\Facades;


use Illuminate\Support\Facades\Facade;

class GalleryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "gallery";
    }
} 