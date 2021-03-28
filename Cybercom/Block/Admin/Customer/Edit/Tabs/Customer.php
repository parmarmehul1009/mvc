<?php

namespace Block\Admin\Customer\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');

class Customer extends \Block\Core\Edit
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/customer/edit/tabs/customer.php');
    }

    public function getCustomer()
    {
        return $this->getTableRow();
    }

    public function getCustomerGroups()
    {
        $customerGroup = \Mage::getBlock('Model\Customer\Group');
        return $customerGroup->fetchAll();
    }
}
