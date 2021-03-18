<?php

namespace Block\Admin\Customer\Group;

\Mage::loadFileByClassName('Block\Core\Edit');

class Grid extends \Block\Core\Edit
{
    protected $customerGroups = [];
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/customer/group/grid.php');
    }

    public function setCustomerGroups($customerGroups = null)
    {
        if ($customerGroups) {
            $this->customerGroups = $customerGroups;
            return $this;
        }
        $customerGroup = \Mage::getModel('Model\Customer\Group');
        $customerGroups = $customerGroup->fetchAll();

        $this->customerGroups = $customerGroups;
    }

    public function getCustomerGroups()
    {
        if (!$this->customerGroups) {
            $this->setCustomerGroups();
        }
        return $this->customerGroups;
    }
}
