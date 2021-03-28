<?php

namespace Block\Customer\Layout\Header;

\Mage::loadFileByClassName('Block\Core\Template');
class Right extends \Block\Core\Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/customer/layout/header/right.php');
    }
}
