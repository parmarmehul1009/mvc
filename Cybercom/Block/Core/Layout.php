<?php

namespace Block\Core;

\Mage::loadFileByClassName('Block\Core\Template');
class Layout extends Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/core/layout/oneColumn.php');
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
