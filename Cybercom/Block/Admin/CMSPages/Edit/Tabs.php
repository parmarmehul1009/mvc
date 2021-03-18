<?php

namespace Block\Admin\CMSPages\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTabs()
    {
        parent::prepareTabs();
        $this->addTab('cmspage', ['label' => 'CMS Page', 'block' => 'Block\Admin\CMSPages\Edit\Tabs\Form']);
        $this->setDefaultTab('cmspage');
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
