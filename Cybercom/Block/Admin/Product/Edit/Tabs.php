<?php

namespace Block\Admin\Product\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTabs()
    {
        parent::prepareTabs();
        $this->addTab('product', ['label' => 'Product Information', 'block' => 'Block\Admin\Product\Edit\Tabs\Form']);
        $this->addTab('media', ['label' => 'Media', 'block' => 'Block\Admin\Product\Edit\Tabs\Media']);
        $this->addTab('category', ['label' => 'Category', 'block' => 'Block\Admin\Product\Edit\Tabs\Category']);
        $this->addTab('groupPrice', ['label' => 'Group Price', 'block' => 'Block\Admin\Product\Edit\Tabs\GroupPrice']);
        $this->addTab('attribute', ['label' => 'Attribute', 'block' => 'Block\Admin\Product\Edit\Tabs\Attribute']);

        $this->setDefaultTab('product');
    }

    public function getTabs()
    {
        if (!$this->getTableRow()->productId) {
            $this->removeTab('media');
            $this->removeTab('groupPrice');
            $this->removeTab('attribute');
        };
        return $this->tabs;
    }
}
