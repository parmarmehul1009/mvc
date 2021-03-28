<?php

namespace Controller\Admin;

use Exception;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Attribute extends \Controller\Core\Admin
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
        $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function formAction()
    {
        $attribute = \Mage::getModel('Model\Attribute');
        if ($id = $this->getRequest()->getGet('id')) {
            $attribute = $attribute->load($id);
            if (!$attribute) {
                throw new \Exception("Record Not Found.");
            }
        }
        $edit  = \Mage::getBlock('Block\Admin\Attribute\Edit')->setTableRow($attribute)->toHtml();
        $this->makeResponse($edit);
    }

    public function saveAction()
    {
        try {
            $attribute = \Mage::getModel('Model\Attribute');
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request", 1);
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $attribute = $attribute->load($id);
                if (!$attribute) {
                    throw new \Exception("Unable to load data.", 1);
                }
            }
            $attributeData = $this->getRequest()->getPost('attribute');
            $attribute->setData($attributeData);
            $attribute->save();
            $query = "ALTER TABLE `$attribute->entityTypeId` ADD `$attribute->code` $attribute->backendType(45);";
            $attribute->getAdapter()->update($query);
            $this->getMessage()->setSuccess('Attribute Cteated.');
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $attribute = \Mage::getModel('Model\Attribute');
            if ($id = $this->getRequest()->getGet('id')) {
                $attribute = $attribute->load($id);
                if (!$attribute) {
                    throw new \Exception("Unable to load Data.");
                }
                $query = "ALTER TABLE `$attribute->entityTypeId`
            DROP COLUMN $attribute->code;";
                $attribute->getAdapter()->update($query);
                $attribute->delete();
            }
            $this->getMessage()->setSuccess('Attribute Deleted.');
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function filterAction()
    {
        $data = $this->getRequest()->getPost('filter');
        $this->getFilter()->setFilters($data);
        $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
