<?php

namespace Block\Admin\Dashbord;

\Mage::loadFileByClassName('Block\Core\Template');
class index extends \Block\Core\Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/dashbord/index.php');
    }
}
