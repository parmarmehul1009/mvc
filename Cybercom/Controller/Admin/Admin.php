<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Admin extends \Controller\Core\Admin
{

    public function __construct()
    {
        parent::__construct();
        $this->setMessage(\Mage::getModel('Model\Admin\Message'));
    }

    public function indexAction()
    {
        $layout = $this->getlayout();
        $this->renderLayout();
    }
    public function gridAction()
    {
        $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function formAction()
    {
        $admin = \Mage::getModel('Model\Admin');
        if ($id = $this->getRequest()->getGet('id')) {
            $admin = $admin->load($id);
            if (!$admin) {
                throw new \Exception("Record Not Found.");
            }
        }
        $edit = \Mage::getBlock('Block\Admin\Admin\Edit')->setTableRow($admin)->toHtml();
        $this->makeResponse($edit);
    }

    public function saveAction()
    {
        try {
            $admin = \Mage::getModel('Model\Admin');
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalide Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $admin = $admin->load($id);
                if (!$admin) {
                    throw new \Exception("Record Not Found.");
                }
            } else {
                $admin->createdDate = date("Y-m-d H:i:s");
            }
            $adminData = $this->getRequest()->getPost('admin');
            $admin->setData($adminData);
            $recordId = $admin->save();
            if (!$recordId) {
                throw new \Exception("Record Not Inserted.");
            };
            $this->getMessage()->setSuccess('Record Inserted successfully.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($grid);
    }
    public function statusAction()
    {
        try {
            $adminId = (int) $this->getRequest()->getGet('id');
            $status = $this->getRequest()->getGet('status');
            if (!$adminId) {
                throw new \Exception("No Record Found.");
            }
            $admin = \Mage::getModel('Model\Admin');
            $admin->load($adminId);
            $admin->status = $status;
            $recordId = $admin->save();
            if (!$recordId) {
                throw new \Exception("Unable to update Status.");
            };
            $this->getMessage()->setSuccess('Status Updated successfully.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $adminId = (int) $this->getRequest()->getGet('id');
            if (!$adminId) {
                throw new \Exception("Id Not Found.");
            }
            $admin = \Mage::getModel('Model\Admin');
            $admin->load($adminId);
            if (!$admin->delete()) {
                throw new \Exception("No record For Given Id");
            }
            $this->getMessage()->setSuccess('Record Deleted successfully.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
