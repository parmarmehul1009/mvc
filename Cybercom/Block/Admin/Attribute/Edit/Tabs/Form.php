<?php

namespace Block\Admin\Attribute\Edit\Tabs;

use Block\Core\Edit;

\Mage::loadFileByClassName('Block\Core\Edit');
class Form extends Edit
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/attribute/edit/tabs/form.php');
    }
}
