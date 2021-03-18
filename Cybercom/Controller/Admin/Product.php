<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Product extends \Controller\core\Admin
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

    public function gridAction()
    {
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function formAction()
    {

        $product = \Mage::getModel('Model\Product');
        if ($id = $this->getRequest()->getGet('id')) {
            $query = "SELECT P.*,PC.* FROM {$product->getTableName()} AS P JOIN `product_category` AS PC ON P.productId = PC.productId WHERE P.productId = '{$id}'";
            $product = $product->fetchRow($query);
            if (!$product) {
                throw new \Exception("Record Not Found.");
            }
        }
        $edit = \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product)->toHtml();
        $this->makeResponse($edit);
    }

    public function saveAction()
    {
        try {
            $product = \Mage::getModel('Model\Product');
            $product_category = \Mage::getModel('Model\Product\Category');
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalide Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $product = $product->load($id);
                $query = "SELECT * FROM {$product_category->getTableName()} WHERE `productId` = {$id}";
                $product_category = $product_category->fetchRow($query);
                if (!$product) {
                    throw new \Exception("Record Not Found.");
                }
                $product->updatedDate = date("Y-m-d H:i:s");
            } else {
                $product->createdDate = date("Y-m-d H:i:s");
            }
            $productData = $this->getRequest()->getPost('product');
            $product->setData($productData);
            $product->save();
            $productCategoryData = $this->getRequest()->getPost('category');
            $product_category->setData($productCategoryData);
            $product_category->productId = $product->productId;
            $recordId = $product_category->save();
            if (!$recordId) {
                throw new \Exception("Record Not Inserted.");
            };
            $this->getMessage()->setSuccess('Record Inserted successfully.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function statusAction()
    {
        try {
            $productId = (int) $this->getRequest()->getGet('id');
            $status = $this->getRequest()->getGet('status');
            $updateDate = date("Y-m-d H:i:s");
            if (!$productId) {
                throw new \Exception("No Record Found.");
            }
            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if (!$product) {
                throw new \Exception("Record Not Found.");
            }
            $product->status = $status;
            $product->updatedDate = $updateDate;
            $recordId = $product->save();
            if (!$recordId) {
                throw new \Exception("Record Not Updated.");
            };
            $this->getMessage()->setSuccess('Status Updated.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $productId = (int) $this->getRequest()->getGet('id');
            if (!$productId) {
                throw new \Exception("Id Not Found.");
            }
            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if (!$product->delete()) {
                throw new \Exception("No record For Given Id");
            }
            $this->getMessage()->setSuccess('Record Deleted.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
