<?php

namespace Block\Admin\Customer;


\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template
{
    protected $customers = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/customer/grid.php');
    }

    public function setCustomers($customers = null)
    {
        if (!$this->customers) {
            $query = "SELECT C.*,CG.name AS groupName,CA.zipCode FROM customer as C LEFT JOIN customer_group AS CG ON C.groupId = CG.groupId LEFT JOIN customer_address AS CA ON CA.customerId = C.customerId AND CA.addressType = 'Billing'";
            $customer = \Mage::getModel('Model\Customer');
            $customers = $customer->fetchAll($query);
        }
        $this->customers = $customers;
        return $this;
    }

    public function getCustomers()
    {
        if (!$this->customers) {
            $this->setCustomers();
        }
        return $this->customers;
    }
}
