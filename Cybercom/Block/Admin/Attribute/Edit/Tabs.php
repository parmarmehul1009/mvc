<?php

namespace Block\Admin\Attribute\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTabs()
    {
        parent::prepareTabs();
        $this->addTab('attribute', ['label' => 'Attribute', 'block' => 'Block\Admin\Attribute\Edit\Tabs\Form']);
        $this->addTab('option', ['label' => 'Options', 'block' => 'Block\Admin\Attribute\Edit\Tabs\Option']);

        $this->setDefaultTab('attribute');
        return $this;
    }

    public function getTabs()
    {
        if (!$this->getTableRow()->attributeId) {
            $this->removeTab('option');
        };
        return $this->tabs;
    }
}
