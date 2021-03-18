<?php

namespace Block\Admin\CMSPages\Edit\Tabs;


\Mage::loadFileByClassName('Block\Core\Edit');
class Form extends \Block\Core\Edit
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/cmspages/edit/tabs/form.php');
    }
}
