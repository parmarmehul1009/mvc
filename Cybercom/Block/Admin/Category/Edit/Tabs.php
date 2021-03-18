<?php

namespace Block\Admin\Category\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTabs()
    {
        parent::prepareTabs();
        $this->addTab('category', ['label' => 'Category Information', 'block' => 'Block\Admin\Category\Edit\Tabs\Form']);
        $this->addTab('media', ['label' => 'Media', 'block' => 'Block\Admin\Category\Edit\Tabs\Media']);

        $this->setdefaultTab('category');
        return $this;
    }

    public function getTabs()
    {
        if (!$this->getTableRow()->categoryId) {
            $this->removeTab('media');
        };
        return $this->tabs;
    }
}
