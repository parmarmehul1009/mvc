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

    public function getTabs()
    {
        if (!$this->getTableRow()->attributeId) {
        };
        return $this->tabs;
    }
}
