<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Customer extends \Model\Core\Table
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    protected $shipping = null;
    protected $billing = null;
    protected $address = null;
    public function __construct()
    {
        // parent::__construct();
        $this->setTableName('customer');
        $this->setPrimaryKey('customerId');
    }

    public function getStatusOption()
    {
        return [
            self::STATUS_ENABLE => 'Enable',
            self::STATUS_DISABLE => 'Disable'
        ];
    }

    public function setBillingAddress()
    {
        $address = \Mage::getModel('Model\Customer\Address');
        $query = "SELECT * FROM `{$address->getTableName()}` WHERE `customerId` = '{$this->customerId}' AND `addressType` = 'billing'";
        $address = $address->fetchRow($query);
        $this->shipping = $address;
        return $this;
    }

    public function getBillingAddress()
    {
        if (!$this->shipping) {
            $this->setBillingAddress();
        }
        return $this->shipping;
    }

    public function setShippingAddress()
    {
        $address = \Mage::getModel('Model\Customer\Address');
        $query = "SELECT * FROM `{$address->getTableName()}` WHERE `customerId` = '{$this->customerId}' AND `addressType` = 'shipping'";
        $address = $address->fetchRow($query);
        $this->billing = $address;
        return $this;
    }

    public function getShippingAddress()
    {
        if (!$this->billing) {
            $this->setShippingAddress();
        }
        return $this->billing;
    }
}
