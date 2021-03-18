<?php

namespace Block\Admin\Customer\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTabs()
    {
        parent::prepareTabs();
        $this->addTab('customer', ['label' => 'Customer Infromation', 'block' => 'Block\Admin\Customer\Edit\Tabs\Customer']);
        $this->addTab('address', ['label' => 'Address', 'block' => 'Block\Admin\Customer\Edit\Tabs\Address']);
        $this->setdefaultTab('customer');
    }

    public function getTabs()
    {
        if (!$this->getTableRow()->customerId) {
            $this->removeTab('address');
        };
        return $this->tabs;
    }
}
