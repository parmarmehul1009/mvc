<?php

namespace Block\Admin\Admin\Edit\Tabs;

use Block\Core\Edit;

\Mage::loadFileByClassName('Block\Core\Edit');
class Form extends Edit
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/admin/edit/tabs/form.php');
    }
}
