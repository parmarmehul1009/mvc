<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');
class Cart extends \Model\Core\Table
{
    protected $customer = null;
    protected $items = null;
    protected $billingAddress = null;
    protected $shippingAddress = null;
    protected $paymentMethod = null;
    protected $shippingMethod = null;

    public function __construct()
    {
        $this->setTableName('cart');
        $this->setPrimaryKey('cartId');
    }

    public function setCustomer(\Model\Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }
    public function getCustomer()
    {
        if ($this->customer) {
            return $this->customer;
        }
        if (!$this->customerId) {
            return false;
        }
        $customer = \Mage::getModel('Model\Customer')->load($this->customerId);
        $this->setCustomer($customer);
        return $this->customer;
    }
    public function setItems(\Model\Cart\Item\Collection $items)
    {
        $this->items = $items;
        return $items;
    }
    public function getItems()
    {
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM `cartitem` WHERE `cartId`='{$this->cartId}';";
        $items = \Mage::getModel('Model\Cart\Item')->fetchAll($query);

        if ($items) {
            $this->setItems($items);
        }
        return $this->items;
    }
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }
    public function getBillingAddress()
    {
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM `cartAddress` WHERE `cartId` = '{$this->cartId}' AND `addressType`='billing';";
        $billingAddress = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
        $this->setBillingAddress($billingAddress);
        return $this->billingAddress;
    }
    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }
    public function getShippingAddress()
    {
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM `cartAddress` WHERE `cartId` = '{$this->cartId}' AND `addressType`='shipping';";
        $shippingAddress = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
        return $shippingAddress;
    }

    public function setPaymentMethod(\Model\Payment $payment)
    {
        $this->paymentMethod = $payment;
        return $this;
    }

    public function getPaymentMethod()
    {
        if (!$this->paymentMethodId) {
            return false;
        }
        $payment = \Mage::getModel('Model\Payment')->load($this->paymentMethodId);
        $this->setPaymentMethod($payment);
        return $this->paymentMethod;
    }

    public function setShippingMethod(\Model\shipping $shipping)
    {
        $this->shippingMethod = $shipping;
        return $this;
    }

    public function getShippingMethod()
    {
        if (!$this->shippingMethodId) {
            return false;
        }
        $shipping = \Mage::getModel('Model\shipping')->load($this->shippingMethodId);
        $this->setShippingMethod($shipping);
        return $this->shippingMethod;
    }

    public function addItemToCart(\Model\Product $product, $quantity = 1, $addModel = false)
    {
        $item = \Mage::getModel('Model\Cart\Item');
        $query = "SELECT * FROM `{$item->getTableName()}` WHERE `cartId` = {$this->cartId} AND productId = '{$product->productId}'";

        $item = $item->fetchRow($query);

        if ($item) {
            $item->quantity += $quantity;
            $item->save();
            return true;
        }

        $item = \Mage::getModel('Model\Cart\Item');
        $item->cartId = $this->cartId;
        $item->productId = $product->productId;
        $item->basePrice = $product->price;
        $item->quantity = $quantity;
        $item->discount = $product->discount;
        $item->createdDate = date("Y-m-d H:i:s");
        $item->save();
    }
}
