<?php

namespace Block\Core\Edit;

\Mage::loadFileByClassName('Block\Core\Template');
class Tabs extends \Block\Core\Template
{
    protected $tableRow = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/core/edit/tabs.php');
        $this->prepareTabs();
    }
    public function setTableRow(\Model\Core\Table $tableRow)
    {
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow()
    {
        return $this->tableRow;
    }

    public function prepareTabs()
    {
        return $this;
    }

    public function removeTabs()
    {
        return $this;
    }

    public function getTabs()
    {
        return $this->tabs;
    }
}
