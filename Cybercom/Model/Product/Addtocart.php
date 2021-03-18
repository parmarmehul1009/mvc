<?php

namespace Model\Product;

\Mage::loadFileByClassName('Model\Admin\Session');
class Addtocart extends \Model\Admin\Session
{
    protected $cartItem = [];
    public function addToCart($productId)
    {
        $this->cartItem['productId' . $productId] = $productId;
        if (!$this->cart) {
            $this->cart = $this->cartItem;
        }
        $this->cart = array_merge($this->cart, $this->cartItem);
    }

    public function clearCart($productId)
    {
        unset($this->cart);
        $this->setCount(0);
    }

    public function removeItem($productId)
    {
        $key = 'productId' . $productId;
        $this->cartItem = $this->cart;
        if (array_key_exists($key, $this->cartItem)) {
            unset($this->cartItem[$key]);
            $this->cart = $this->cartItem;
        }
    }

    public function getCartItem($productId)
    {
        return $this->cartItem['productId' . $productId];
    }

    public function getCartItems()
    {
        if (!array_key_exists($this->getNameSpace(), $_SESSION)) {
            return null;
        }

        if (!array_key_exists('cart', $_SESSION[$this->getNameSpace()])) {
            return null;
        }

        return $_SESSION[$this->getNameSpace()]['cart'];
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getCount()
    {
        return $this->count;
    }
}
