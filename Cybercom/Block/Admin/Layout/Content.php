<?php

namespace Block\Admin\Layout;

\Mage::loadFileByClassName('Block\Core\Template');
class Content extends \Block\Core\Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/layout/content.php');
    }
}
