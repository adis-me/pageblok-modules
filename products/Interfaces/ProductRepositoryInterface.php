<?php


namespace Pageblok\Products\Interfaces;


use Pageblok\Core\Interfaces\BaseRepositoryInterface;

/**
 * Interface ProductRepositoryInterface
 * @package Pageblok\Products\Interfaces
 */
interface ProductRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * Get product list be category name
     *
     * @param $categoryName
     * @param $includedUnpublished Should we included the unpublished too?
     * @return mixed
     */
    public function getByCategory($categoryName, $includedUnpublished);

    /**
     * Get a list of unique categories
     * @return mixed
     */
    public function getCategories();
} 