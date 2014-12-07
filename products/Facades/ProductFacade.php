<?php


namespace Pageblok\Products\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ProductFacade
 *
 * @package Pageblok\Products\Facades
 * @author  Adis Corovic <adis@live.nl>
 */
class ProductFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "product";
    }
}