<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
class CMSPages extends \Controller\Core\Admin
{
    public function indexAction()
    {
        $layout = $this->getlayout();
        $this->renderLayout();
    }
    public function gridAction()
    {
        $grid = \Mage::getBlock('Block\Admin\CMSPages\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function formAction()
    {
        $cmsPage = \Mage::getModel('Model\CMSPages');
        if ($id = $this->getRequest()->getGet('id')) {
            $cmsPage = $cmsPage->load($id);
            if (!$cmsPage) {
                throw new \Exception("Unable to Load Data.", 1);
            }
        }
        $edit = \Mage::getBlock('Block\Admin\CMSPages\Edit')->setTableRow($cmsPage)->toHtml();
        $this->makeResponse($edit);
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Inavalid Request", 1);
            }
            $cmspage = \Mage::getModel('Model\CMSPages');
            if ($id = $this->getRequest()->getGet('id')) {
                $cmspage = $cmspage->load($id);
                if (!$cmspage) {
                    throw new \Exception("Unable To Load Data.", 1);
                }
            } else {
                $cmspage->createdDate = date("Y-m-d H:i:s");
            }
            $cmspageData = $this->getRequest()->getPost('cms_page');
            $cmspage->setData($cmspageData);
            $cmspage->save();
            $this->getMessage()->setSuccess('Record Inserted successfully.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\CMSPages\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function statusAction()
    {
        try {
            $cmspage = \Mage::getModel('Model\CMSPages');
            if ($id = $this->getRequest()->getGet('id')) {
                $cmspage = $cmspage->load($id);
                if (!$cmspage) {
                    throw new \Exception("Unable to Load Data.", 1);
                }
            }
            $cmspage->status = !$cmspage->status;
            $cmspage->save();
            $this->getMessage()->setSuccess('Status Updated.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\CMSPages\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $cmspage = \Mage::getModel('Model\CMSPages');
            if ($id = $this->getRequest()->getGet('id')) {
                $cmspage = $cmspage->load($id);
                if (!$cmspage) {
                    throw new \Exception("Unable To load Data.", 1);
                }
            }
            $cmspage->delete();
            $this->getMessage()->setSuccess('Record Deleted.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\CMSPages\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
