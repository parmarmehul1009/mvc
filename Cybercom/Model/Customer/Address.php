<?php

namespace Model\Customer;

\Mage::loadFileByClassName('Model\Core\Table');

class Address extends \Model\Core\Table
{
    public function __construct()
    {
        $this->settableName('customer_address');
        $this->setPrimaryKey('addressId');
    }
}
