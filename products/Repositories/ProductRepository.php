<?php


namespace Pageblok\Products\Repositories;


use Pageblok\Products\Interfaces\ProductRepositoryInterface;
use Pageblok\Core\Repositories\BaseRepository;

/**
 * Class ProductRepository
 * @package Pageblok\Products\Repositories
 * @author Adis Corovic <adis@live.nl>
 */
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function getByCategory($categoryName, $includedUnpublished = true)
    {
        if ( ! $includedUnpublished ) {
            return $this->model->where('group', $categoryName)->where('published', false)->paginate($this->model->getPageSize());
        }
        return $this->model->where('group', $categoryName)->paginate($this->model->getPageSize());
    }

    /**
     * @inheritdoc
     */
    public function getCategories()
    {
        $result = \DB::table('products')->lists('category');

        return array_filter(array_unique($result));
    }

} 