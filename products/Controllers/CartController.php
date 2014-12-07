<?php


namespace Pageblok\Products\Controllers;

use Illuminate\Http\Response;
use Pageblok\Products\Interfaces\ProductRepositoryInterface;


/**
 * Class CartController
 * @package Pageblok\Products\Controllers
 */
class CartController extends \Controller
{
    /**
     * Product repository
     * @var ProductRepositoryInterface
     */
    protected $repository;

    /**
     * What is the custom cart template that we need to use
     * @var string
     */
    protected $cartTemplate = "";

    /**
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->cartTemplate = \Setting::get('app.products.cart.overview');
    }

    /**
     * Show cart overview
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
        return \View::make($this->cartTemplate, $data);
    }

    /**
     * Delete item from cart
     */
    public function deleteFromCart()
    {
        $product = $this->repository->findById(\Input::get('id'));
        $result = \Product::deleteFromCart($product);

        $totalCartPrice = \Product::getTotalCartPrice();
        $data = [
            'totalCartPrice' => '€&nbsp;' . \Product::getTotalCartPrice(),
            'cartIsEmpty' => $totalCartPrice == money_format('%i', 0) ? true : false,
        ];

        return \Response::json($data);
    }

    /**
     * Update cart quantity
     */
    public function updateQuantity()
    {
        $product = $this->repository->findById(\Input::get('id'));
        $product->quantity = \Input::get('quantity');
        $result = \Product::updateShoppingCart($product);

        $data = [
            'totalPrice' => '€&nbsp;' . $product->totalPrice,
            'totalCartPrice' => '€&nbsp;' . \Product::getTotalCartPrice(),
        ];

        return \Response::json($data);
    }
} 