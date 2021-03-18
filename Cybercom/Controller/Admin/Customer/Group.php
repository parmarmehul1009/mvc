<?php

namespace Controller\Admin\Customer;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Group extends \Controller\Core\Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {
        $grid = \Mage::getBlock('Block\Admin\Customer\Group\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function formAction()
    {
        $customerGroup = \Mage::getModel('Model\Customer\Group');
        if ($id = $this->getRequest()->getGet('id')) {
            $customerGroup = $customerGroup->load($id);
            if (!$customerGroup) {
                throw new \Exception("No Record Found");
            }
        }
        $edit = \Mage::getBlock('Block\Admin\Customer\Group\Edit')->setTableRow($customerGroup)->toHtml();
        $this->makeResponse($edit);
    }

    public function saveAction()
    {
        try {
            $customerGroup = \Mage::getModel('Model\Customer\Group');
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $customerGroup = $customerGroup->load($id);
                if (!$customerGroup) {
                    throw new \Exception("No Record Found.");
                }
            } else {
                $customerGroup->createdDate = date("Y-m-d H:i:s");
            }
            $customerGroupData = $this->getRequest()->getPost('customer_group');
            $customerGroup->setData($customerGroupData);
            $recordId = $customerGroup->save();
            if (!$recordId) {
                throw new \Exception("Record Not Inserted.");
            }
            $this->getMessage()->setSuccess('Record Inserted.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Customer\Group\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function statusAction()
    {
        try {
            $customerGroup = \Mage::getModel('Model\Customer\Group');
            $status = $this->getRequest()->getGet('status');
            if ($id = $this->getRequest()->getGet('id')) {
                $customerGroup = $customerGroup->load($id);
                if (!$customerGroup) {
                    throw new \Exception("No Record Found.");
                }
            }
            $customerGroup->status = $status;
            $recordId = $customerGroup->save();
            if (!$recordId) {
                throw new \Exception("Unable to update status.");
            }
            $this->getMessage()->setSuccess('Status Update successfully.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Customer\Group\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $customerGroup = \Mage::getModel('Model\Customer\Group');
            if ($id = $this->getRequest()->getGet('id')) {
                $customerGroup = $customerGroup->load($id);
                if (!$customerGroup) {
                    throw new \Exception("Record Not found.");
                }
                $recordId = $customerGroup->delete();
                if (!$recordId) {
                    throw new \Exception("Unable To delete Record.");
                }
            }
            $this->getMessage()->setSuccess('Record Deleted Successfully.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Customer\Group\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
