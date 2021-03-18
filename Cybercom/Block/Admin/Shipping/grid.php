<?php

namespace Block\Admin\Shipping;

\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template
{
    protected $shippings = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/shipping/grid.php');
        $this->setController(\Mage::getController('Controller\Admin\Shipping'));
    }

    public function setShippings($shippings = null)
    {
        if (!$shippings) {
            $shipping = \Mage::getModel('Model\Shipping');
            $shippings = $shipping->fetchAll();
        }
        $this->shippings = $shippings;
        return $this;
    }

    public function getShippings()
    {
        if (!$this->shippings) {
            $this->setShippings();
        }
        return $this->shippings;
    }
}
