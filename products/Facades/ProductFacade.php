<?php


namespace Pageblok\Products\Facades;

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