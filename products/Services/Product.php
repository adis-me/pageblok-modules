<?php


namespace Pageblok\Products\Services;


use Pageblok\Products\Interfaces\ProductRepositoryInterface;

class Product
{

    protected $repository;

    /**
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($inputParams)
    {
        return $this->repository->allPaged();
    }

    /**
     * Get a list of all the product categories
     *
     * @return mixed
     */
    public function getCategories()
    {
        return $this->repository->getCategories();
    }

    /**
     * Check if shopping cart contains some items
     *
     * @return bool
     */
    public function shoppingCartContainsItems()
    {
        return 0 === count(\Session::get('users.cart')) ? false : true;
    }

    /**
     * Get the content of the shopping cart
     *
     * @return mixed
     */
    public function getShoppingCart()
    {
        return \Session::get('users.cart');
    }

    /**
     * Add items to the shopping cart
     * @param \Pageblok\Products\Models\Product $aProduct
     * @return void
     */
    public function addToShoppingCart(\Pageblok\Products\Models\Product $aProduct)
    {
        // in case user select the same product twice and adds it independently
        $shoppingCart = \Session::pull('users.cart', array());

        foreach ($shoppingCart as $key => $cartItem) {
            if ($cartItem->id === $aProduct->id) {
                $aProduct->quantity += $cartItem->quantity;
                unset($shoppingCart[$key]);
            }
        }
        $shoppingCart[] = $aProduct;

        // put everything what is left in the cart to the session
        return \Session::put('users.cart', $shoppingCart);
    }

    /**
     * Update the shopping cart
     * @param \Pageblok\Products\Models\Product $aProduct
     * @return void
     */
    public function updateShoppingCart(\Pageblok\Products\Models\Product $aProduct)
    {
        $shoppingCart = \Session::pull('users.cart');

        foreach ($shoppingCart as $key => $cartItem) {
            if ($cartItem->id === $aProduct->id) {
                unset($shoppingCart[$key]);
            }
        }
        if ($aProduct->quantity) { // just in case user set the quantity to ZERO
            // store the new product to the cart
            $shoppingCart[] = $aProduct;
        }

        // put everything what is left in the cart to the session
        return \Session::put('users.cart', $shoppingCart);
    }

    /**
     * Delete item from the shoppingcart
     * @param $productId
     * @return void
     */
    public function deleteFromCart($aProduct)
    {
        $shoppingCart = \Session::pull('users.cart');

        foreach ($shoppingCart as $key => $cartItem) {
            if ($cartItem->id === $aProduct->id) {
                unset($shoppingCart[$key]);
            }
        }
        // put everything what is left in the cart to the session
        return \Session::put('users.cart', $shoppingCart);
    }

    /**
     * Get the total price of the items in the cart
     * @return int
     */
    public function getTotalCartPrice()
    {
        $totalPrice = 0;
        foreach (\Session::get('users.cart') as $cartItem) {
            $quantity = $cartItem->quantity ?: 1;
            $totalPrice += ($quantity * $cartItem->price);
        }

        return money_format('%i', $totalPrice);
    }
} 