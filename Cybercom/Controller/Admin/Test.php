<?php

namespace Controller\Admin;

class Test extends \Controller\Core\Admin
{
    public function testAction()
    {
        $query = "SELECT * FROM `product` WHERE `productId` = '2'";
        $products = \Mage::getModel('Model\Product')->fetchAll();
        echo '<pre>';
        // $products->name = 'Mobile';
        print_r($products);
    }
}
