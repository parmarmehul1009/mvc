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
            $product = $product->load($id);
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
            if ($productCategoryData) {
                $product_category = \Mage::getModel('Model\Product\Category');
                $query = "DELETE FROM `{$product_category->getTableName()}` WHERE `productId` = {$product->productId}";
                $product_category->getAdapter()->update($query);
                foreach ($productCategoryData as $key => $category) {
                    $product_category = \Mage::getModel('Model\Product\Category');
                    $product_category->categoryId = $category;
                    $product_category->productId = $product->productId;
                    $product_category->save();
                }
            }
            // $recordId = $product_category->save();

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

    public function filterAction()
    {
        $data = $this->getRequest()->getPost('filter');
        $this->getFilter()->setFilters($data);
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
