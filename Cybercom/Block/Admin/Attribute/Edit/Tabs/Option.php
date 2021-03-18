<?php

namespace Block\Admin\Attribute\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class Option extends \Block\Core\Edit
{
    protected $options = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/attribute/edit/tabs/option.php');
    }

    public function setOptions()
    {
        $option = \Mage::getModel('Model\Attribute\Option');
        $query = "SELECT * FROM `{$option->getTableName()}` WHERE `attributeId` = '{$this->getTableRow()->attributeId}'";
        $this->options = $option->fetchAll($query);
        return $this;
    }

    public function getOptions()
    {
        if (!$this->options) {
            $this->setOptions();
        }
        return $this->options;
    }
}
