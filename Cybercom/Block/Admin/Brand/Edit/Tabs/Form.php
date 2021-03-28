<?php

namespace Block\Admin\Brand\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class Form extends \Block\Core\Edit
{
    protected $categoriesOptions = [];
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/brand/edit/tabs/form.php');
    }
}
