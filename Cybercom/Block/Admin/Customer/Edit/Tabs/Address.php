<?php

namespace Block\Admin\Customer\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');

class Address extends \Block\Core\Edit
{
    protected $shipping = null;
    protected $billing = null;
    protected $address = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/customer/edit/tabs/address.php');
        $this->setAddress();
    }

    public function setAddress($address = null)
    {
        try {
            if ($address) {
                $this->address = $address;
            }
            $billing = \Mage::getModel('Model\Customer\Address');
            $shipping = \Mage::getModel('Model\Customer\Address');
            $customer = \Mage::getModel('Model\Customer');
            $address = \Mage::getModel('Model\Customer\Address');
            if ($id = $this->getRequest()->getGet('id')) {
                $customer = $customer->load($id);
                if (!$customer) {
                    throw new \Exception("No Record Found.");
                }
                $query = "SELECT * FROM `customer_address` WHERE customerId = {$customer->customerId}";
                $addresses = $address->fetchAll($query);
                if ($addresses) {
                    foreach ($addresses->getData() as $address) {
                        if ($address->addressType == 'Billing') {
                            $billing = $address;
                        }
                        if ($address->addressType == 'Shipping') {
                            $shipping = $address;
                        }
                    }
                }
            }
            $this->shipping = $shipping;
            $this->billing = $billing;
        } catch (\Exception $e) {
            $message = \Mage::getModel('Model\Admin\Message');
            $message->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }


    public function getBillingAddress()
    {
        return $this->billing;
    }

    public function getShippingAddress()
    {
        return $this->shipping;
    }
}
