<?php

namespace Block\Admin\Shipping\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTabs()
    {
        parent::prepareTabs();
        $this->addTab('shipping', ['label' => 'Shipping', 'block' => 'Block\Admin\Shipping\Edit\Tabs\Form']);

        $this->setDefaultTab('shipping');
        return $this;
    }

    public function removeTabs()
    {
        $this->removeTab('address');
    }

    public function removeTab($key)
    {
        if (array_key_exists($key, $this->tabs)) {
            $this->unsetTab($key);
        }
    }

    public function getTabs()
    {
        if (!$this->getTableRow()->customerId) {
            $this->removeTabs();
        };
        return $this->tabs;
    }
}
