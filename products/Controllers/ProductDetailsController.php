<?php


namespace Pageblok\Products\Controllers;

use Pageblok\Products\Interfaces\ProductRepositoryInterface;


/**
 * Class ProductDetailsController
 * @package Pageblok\Products\Controllers
 */
class ProductDetailsController extends \Controller
{
    /**
     * Product repository
     *
     * @var ProductRepositoryInterface
     */
    protected $repository;

    /**
     * Template for showing product details
     *
     * @var string
     */
    protected $detailsTemplate;

    /**
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->detailsTemplate = \Setting::get('app.products.details.template');
    }

    /**
     * Show product details
     * @param $id
     * @return \Illuminate\View\View
     */
    public function details($id)
    {
        $data = [
            'product' => $this->repository->findById($id),
        ];

        return \View::make($this->detailsTemplate, $data);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function addToCart()
    {
        $product = $this->repository->findById(\Input::get('id'));
        $product->quantity = \Input::get('quantity');
        $result = \Product::addToShoppingCart($product);

        if ($result) {
            \Notification::success(\Lang::get('products.added.to.cart'));
        } else {
            \Notification::error(\Lang::get('products.not.added.to.cart'));
        }

        return \Redirect::to(
            \Config::get(
                'products::app.shop.url', /* default */
                '/shop'
            )
        );
    }
} 