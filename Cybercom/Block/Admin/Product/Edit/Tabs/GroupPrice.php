<?php

namespace Block\Admin\Product\Edit\Tabs;

use Block\Core\Edit;
use Exception;

class GroupPrice extends Edit
{
    protected $groupPrices = null;
    protected $product = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/product/edit/tabs/groupprice.php');
    }

    public function setGroupPrices($groupPrice = null)
    {

        try {
            if ($groupPrice) {
                $this->groupPrice = $groupPrice;
                return $this;
            }

            $groupPrice = \Mage::getModel('Model\Product\Customer\Group\Price');
            $query = "SELECT CG.* ,PCGP.productId,PCGP.entityId,PCGP.price AS groupPrice
            FROM `customer_group` AS CG 
            LEFT JOIN `product_customer_group_price` AS PCGP  
            ON CG.groupId = PCGP.customerGroupId 
                AND PCGP.productId = '{$this->getTableRow()->productId}'
            LEFT JOIN `product` AS P 
            ON P.productId = PCGP.productId";
            $groupPrices = $groupPrice->fetchAll($query);
            $this->groupPrices = $groupPrices;
        } catch (Exception $e) {
        }
    }

    public function getGroupPrices()
    {
        if (!$this->groupPrices) {
            $this->setGroupPrices();
        }
        return $this->groupPrices;
    }

    public function setProduct()
    {
        if ($productId = $this->getRequest()->getGet('id')) {
            $product = \Mage::getModel('Model\Product');
            $product = $product->load($productId);
            if (!$product) {
                throw new \Exception("No Product For Given Id", 1);
            }
            $this->product = $product;
            return $this;
        }
    }

    public function getProduct()
    {
        if (!$this->product) {
            $this->setProduct();
        }
        return $this->product;
    }
}
