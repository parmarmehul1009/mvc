<?php

namespace Block\Core;

\Mage::loadFileByClassName('Block\Core\Template');
class Layout extends Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/core/layout/oneColumn.php');
        $this->prepareChildren();
    }
    public function prepareChildren()
    {
        $this->addChild(\Mage::getBlock('Block\Core\Layout\Header'), 'header');
        $this->addChild(\Mage::getBlock('Block\Core\Layout\Content'), 'content');
        $this->addChild(\Mage::getBlock('Block\Core\Layout\Footer'), 'footer');
        $this->addChild(\Mage::getBlock('Block\Core\Layout\Left'), 'left');
        $this->addChild(\Mage::getBlock('Block\Core\Layout\Right'), 'right');
    }

    public function getContent()
    {
        return $this->getChild('content');
    }

    public function getLeft()
    {
        return $this->getChild('left');
    }
    public function getRight()
    {
        return $this->getChild('right');
    }
}
