<?php

namespace Block\Admin\Payment\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTabs()
    {
        parent::prepareTabs();
        $this->addTab('payment', ['label' => 'Payment', 'block' => 'Block\Admin\Payment\Edit\Tabs\Form']);
        $this->setDefaultTab('payment');
        return $this;
    }

    public function removeTabs()
    {
        $this->removeTab('option');
    }

    public function removeTab($key)
    {
        if (array_key_exists($key, $this->tabs)) {
            $this->unsetTab($key);
        }
    }

    public function getTabs()
    {
        if (!$this->getTableRow()->attributeId) {
            $this->removeTabs();
        };
        return $this->tabs;
    }
}
