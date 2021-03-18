<?php

namespace Block\Admin\Customer\Group;

\Mage::loadFileByClassName('Block\Core\Edit');

class Edit extends \Block\Core\Edit
{
    protected $customerGroup = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/customer/group/edit.php');
    }

    // public function setCustomerGroup($customerGroup = null)
    // {
    //     try {
    //         if ($customerGroup) {
    //             $this->customerGroup = $customerGroup;
    //             return $this;
    //         }
    //         $customerGroup = \Mage::getModel('Model\Customer\Group');
    //         if ($id = $this->getRequest()->getGet('id')) {
    //             $customerGroup = $customerGroup->load($id);
    //             if (!$customerGroup) {
    //                 throw new \Exception("No Record Found");
    //             }
    //         }
    //         $this->customerGroup = $customerGroup;
    //     } catch (\Exception $e) {
    //         $this->getMessage()->setFailure($e->getMessage());
    //         $this->redirect('form');
    //     }
    // }

    // public function getCustomerGroup()
    // {
    //     if (!$this->customerGroup) {
    //         $this->setCustomerGroup();
    //     }
    //     return $this->customerGroup;
    // }
}
