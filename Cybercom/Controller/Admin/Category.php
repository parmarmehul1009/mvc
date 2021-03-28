<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Category extends \Controller\Core\Admin
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
    function gridAction()
    {
        $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    function formAction()
    {
        $category = \Mage::getModel('Model\Category');
        if ($id = $this->getRequest()->getGet('id')) {
            $category->load($id);
            if (!$category) {
                throw new \Exception("No Record For given Id.");
            }
        }
        $edit = \Mage::getBlock('Block\Admin\Category\Edit')->setTableRow($category)->toHtml();
        $this->makeResponse($edit);
    }
    function saveAction()
    {
        try {
            $category = \Mage::getModel('Model\Category');
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalide Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $category  = $category->load($id);
                if (!$category) {
                    throw new \Exception("Record not found.");
                }
            }

            $categorypathId = $category->pathId;
            $postDate = $this->getRequest()->getPost('category');

            $category->setData($postDate);
            $category->save();

            $category->updatePathId();
            $category->updateChildrenPathIds($categorypathId);
            $this->getMessage()->setSuccess('Category Created.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    function statusAction()
    {
        try {
            $categoryId = (int) $this->getRequest()->getGet('id');
            $status = $this->getRequest()->getGet('status');
            if (!$categoryId) {
                throw new \Exception("No Record Found.");
            }
            $category = \Mage::getModel('Model\Category');
            $category->load($categoryId);
            $category->status = $status;
            $recordId = $category->save();
            if (!$recordId) {
                throw new \Exception("Unable to update Status.");
            }
            $this->getMessage()->setSuccess('Status Updated.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    function deleteAction()
    {
        try {
            $categoryId = (int) $this->getRequest()->getGet('id');
            if (!$categoryId) {
                throw new \Exception("Id Not Found.");
            }
            $category = \Mage::getModel('Model\Category');
            $category = $category->load($categoryId);
            if (!$category) {
                throw new \Exception("Unable to find The Record.", 1);
            }
            $pathId = $category->pathId;
            $parentId = $category->parentId;
            $category->updateChildrenPathIds($pathId, $categoryId, $parentId);
            $category->load($categoryId);
            $category->delete();
            $this->getMessage()->setSuccess('Category Deleted.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function filterAction()
    {
        $data = $this->getRequest()->getPost('filter');
        $this->getFilter()->setFilters($data);
        $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
