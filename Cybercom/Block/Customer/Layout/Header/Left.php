<?php

namespace Block\Customer\Layout\Header;

\Mage::loadFileByClassName('Block\Core\Template');
class Left extends \Block\Core\Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/customer/layout/header/left.php');
    }
}
