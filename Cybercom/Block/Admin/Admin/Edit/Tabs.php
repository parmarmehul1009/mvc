<?php

namespace Block\Admin\Admin\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTabs()
    {
        parent::prepareTabs();
        $this->addTab('admin', ['label' => 'Admin', 'block' => 'Block\Admin\Admin\Edit\Tabs\Form']);

        $this->setDefaultTab('admin');
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
