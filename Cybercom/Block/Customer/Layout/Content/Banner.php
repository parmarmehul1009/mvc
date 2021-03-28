<?php

namespace Block\Customer\Layout\Content;

\Mage::loadFileByClassName('Block\Core\Template');
class Banner extends \Block\Core\Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/customer/layout/content/banner.php');
    }
}
