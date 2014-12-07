<?php


namespace Pageblok\products\Controllers;

use Pageblok\Products\Interfaces\ProductRepositoryInterface;


/**
 * Class CheckOutController
 * @package Pageblok\products\Controllers
 */
class CheckOutController extends \Controller
{

    /**
     * @var ProductRepositoryInterface
     */
    protected $repository;

    /**
     * @var
     */
    protected $checkOutTemplate;

    /**
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->checkOutTemplate = \Setting::get('app.products.checkout.overview');
    }

    /**
     * User places an order what do we need to do
     */
    public function index()
    {
        // check if users cart is filled, otherwise redirect to home
        if (! \Session::has('users.cart')) {
            return \Redirect::route('app.home');
        }
        $data = [
            'cartItems' => \Product::getShoppingCart(),
            'totalPrice' => \Product::getTotalCartPrice()
        ];

        return \View::make($this->checkOutTemplate, $data);
    }
} 