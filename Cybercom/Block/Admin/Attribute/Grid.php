<?php

namespace Block\Admin\Attribute;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareColumns()
    {
        $this->addColumn('attributeId', [
            'field' => 'attributeId',
            'label' => 'Attribute Id',
            'type' => 'number',
        ]);

        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'Attribute Name',
            'type' => 'text',
        ]);

        $this->addColumn('entityTypeId', [
            'field' => 'entityTypeId',
            'label' => 'Attribute AntityTypeId',
            'type' => 'text',
        ]);

        $this->addColumn('sortOrder', [
            'field' => 'sortOrder',
            'label' => 'Attribute sortOrder',
            'type' => 'number',
        ]);
    }

    public function prepareActions()
    {

        $this->addAction('edit', [
            'label' => 'Edit',
            'method' => 'getEditUrl',
            'ajax' => true,
        ]);

        $this->addAction('delete', [
            'label' => 'Delete',
            'method' => 'getDeleteUrl',
            'ajax' => true,
        ]);
    }


    public function getEditUrl($row)
    {

        $url = $this->getUrl('form', 'admin_attribute', ['id' => $row->attributeId], true);
        echo "mage.setUrl('{$url}').load()";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl('delete', 'admin_attribute', ['id' => $row->attributeId], true);
        echo "mage.setUrl('{$url}').load()";
    }


    public function prepareButtons()
    {
        $this->addButton('addnew', [
            'label' => 'Add New',
            'method' => 'getAddNewUrl',
        ]);

        $this->addButton('applyfilter', [
            'label' => 'Apply Filter',
            'method' => 'getApplyFilterUrl',
        ]);
    }


    public function getAddNewUrl()
    {
        $url = $this->getUrl('form', 'admin_attribute');
        echo "mage.setUrl('{$url}').load()";
    }

    public function prepareCollection()
    {
        $filters = $this->getFilter()->getFilters();
        $this->getFilter()->clearFilters();
        $attribute = \Mage::getModel('Model\Attribute');
        $query = "SELECT * FROM `{$attribute->getTableName()}`";
        if ($filters) {
            $str = '';
            foreach ($filters as $fild => $value) {
                if ($value) {
                    $str .= "`{$fild}` LIKE '%{$value}%' ";
                }
            }
            $query = "SELECT * FROM `{$attribute->getTableName()}` WHERE {$str}";
            if ($str == '') {
                $query = "SELECT * FROM `{$attribute->getTableName()}`";
            }
        }
        $collection = $attribute->fetchAll($query);
        $this->setCollection($collection);
        $this->getFilter()->clearFilters();
        return $this;
    }

    public function getTitle()
    {
        return 'Manage Attribute';
    }

    public function getApplyFilterUrl()
    {
        $url = $this->getUrl('filter', 'admin_attribute', null, true);
        echo "mage.setForm(this).setUrl('{$url}').load()";
    }
}
