<?php

namespace Block\Admin\Payment;

\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template
{
    protected $payments = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./View/admin/Payment/grid.php");
        $this->setController(\Mage::getController('Controller\Admin\Payment'));
    }

    public function setPayments($payments = null)
    {
        if ($payments) {
            $this->payments = $payments;
        }
        $payment = \Mage::getModel('Model\Payment');
        $payments = $payment->fetchAll();
        $this->payments = $payments;
    }

    public function getPayments()
    {
        if (!$this->payments) {
            $this->setPayments();
        }
        return $this->payments;
    }
}
