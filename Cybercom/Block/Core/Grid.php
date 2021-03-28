<?php

namespace Block\Core;

\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
    protected $columns = [];
    protected $collection = null;
    protected $actions = [];
    protected $buttons = [];
    protected $pager = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/core/grid.php');
        $this->prepareColumns();
        $this->prepareActions();
        $this->prepareButtons();
        $this->prepareCollection();
    }

    public function prepareColumns()
    {
        return $this;
    }

    public function getFildValue($row, $field)
    {
        return $row->$field;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function prepareActions()
    {
        return $this;
    }

    public function addAction($key, $value)
    {
        $this->actions[$key] = $value;
        return $this;
    }
    public function getMethodUrl($row, $methodName)
    {
        $this->$methodName($row);
    }


    public function getButtons()
    {
        return $this->buttons;
    }

    public function prepareButtons()
    {
        return $this;
    }

    public function getButtonUrl($methodName)
    {
        $this->$methodName();
    }



    public function addButton($key, $value)
    {
        $this->buttons[$key] = $value;
        return $this;
    }


    public function getCollection()
    {
        return $this->collection;
    }

    public function prepareCollection()
    {
        return $this;
    }

    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    public function addColumn($key, $value)
    {
        $this->columns[$key] = $value;
        return $this;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getTitle()
    {
        return 'Manage Module';
    }

    public function getFilter()
    {
        $controller = \Mage::getController('Controller\Core\Admin');
        return $controller->getFilter();
    }

    public function getApplyFilterUrl()
    {
        echo "mage.setForm(this).load()";
    }

    public function getPager()
    {
        if (!$this->pager) {
            $this->pager =  \Mage::getController('Controller\Core\Pager');
        }
        return $this->pager;
    }
}
