<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Customer extends \Controller\Core\Admin
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
        $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    function formAction()
    {
        $customer = \Mage::getModel('Model\Customer');
        if ($id = $this->getRequest()->getGet('id')) {
            $customer = $customer->load($id);
            if (!$customer) {
                throw new \Exception("No Record Found.");
            }
        }
        $edit = \Mage::getBlock('Block\Admin\Customer\Edit')->setTableRow($customer)->toHtml();
        $this->makeResponse($edit);
    }
    function saveAction()
    {
        try {
            $customer = \Mage::getModel('Model\Customer');
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalide Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $customer = $customer->load($id);
                if (!$customer) {
                    throw new \Exception("No Record Found.");
                }
                $customer->updatedDate = date("Y-m-d H:i:s");
            } else {
                $customer->createdDate = date("Y-m-d H:i:s");
            }
            $customerDate = $this->getRequest()->getPost('customer');
            $customer->setData($customerDate);
            $recordId = $customer->save();
            if (!$recordId) {
                throw new \Exception("Unable to Save Data.");
            }
            $this->getMessage()->setSuccess('Record Saved.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    function statusAction()
    {
        try {
            $customer = \Mage::getModel('Model\Customer');
            if ($customerId = (int) $this->getRequest()->getGet('id')) {
                $customer = $customer->load($customerId);
                if (!$customer) {
                    throw new \Exception("Unable to Load Data.");
                }
            }
            $customer->status = !$customer->status;
            $customer->updatedDate = date("Y-m-d H:i:s");
            $recordId = $customer->save();
            if (!$recordId) {
                throw new \Exception("Unable to update Status.");
            };
            $this->getMessage()->setSuccess('Status Updated.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    function deleteAction()
    {
        try {
            $customerId = (int) $this->getRequest()->getGet('id');
            if (!$customerId) {
                throw new \Exception("No id Found.");
            }
            $customer = \Mage::getModel('Model\Customer');
            $customer->load($customerId);
            if (!$customer->delete()) {
                throw new \Exception("No record For Given Id");
            }
            $this->getMessage()->setSuccess('Record Deleted.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function filterAction()
    {
        $data = $this->getRequest()->getPost('filter');
        $this->getFilter()->setFilters($data);
        $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
