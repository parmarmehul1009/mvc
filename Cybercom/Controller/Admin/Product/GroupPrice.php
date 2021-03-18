<?php

namespace Controller\Admin\Product;

use Exception;

\Mage::loadFileByClassName('Controller\Core\Admin');
class GroupPrice extends \Controller\Core\Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $layout = $this->getlayout();
        $this->renderLayout();
    }

    public function saveAction()
    {
        $groupPrice = \Mage::getModel('Model\Product\Customer\Group\Price');
        $groupPriceData = $this->getRequest()->getPost('groupPrice');
        $product = \Mage::getModel('Model\Product');
        $productId  = (int)$this->getRequest()->getGet('id');
        try {
            $product = $product->load($productId);
            if (!$product) {
                throw new Exception("Unable to Load Data.", 1);
            }
            $price = $groupPriceData['groupPrice'];
            if (array_key_exists('new', $groupPriceData)) {
                $new = $groupPriceData['new'];
                foreach ($new as $groupId => $row) {
                    $groupPrice = \Mage::getModel('Model\Product\Customer\Group\Price');
                    $groupPrice->productId = $productId;
                    $groupPrice->price = $price[$groupId];
                    $groupPrice->customerGroupId = $groupId;
                    $groupPrice->save();
                }
            }
            if (array_key_exists('exist', $groupPriceData)) {
                $exist = $groupPriceData['exist'];
                foreach ($exist as $groupId => $row) {
                    $groupPrice = \Mage::getModel('Model\Product\Customer\Group\Price')->load($row);
                    $groupPrice->price = $price[$groupId];
                    $groupPrice->save();
                }
            }
            $this->getMessage()->setSuccess('Record Inserted successfully.');
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
