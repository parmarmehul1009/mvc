<?php

namespace Block\Admin\shipping;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareColumns()
    {
        $this->addColumn('methodId', [
            'field' => 'methodId',
            'label' => 'Shipping Id',
            'type' => 'number',
        ]);

        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'Name',
            'type' => 'text',
        ]);

        $this->addColumn('amount', [
            'field' => 'amount',
            'label' => 'Shipping amount',
            'type' => 'text',
        ]);

        $this->addColumn('code', [
            'field' => 'code',
            'label' => 'Shipping Code',
            'type' => 'text',
        ]);

        $this->addColumn('description', [
            'field' => 'description',
            'label' => 'Shipping Description',
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

        $url = $this->getUrl('form', 'admin_shipping', ['id' => $row->methodId], true);
        echo "mage.setUrl('{$url}').load()";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl('delete', 'admin_shipping', ['id' => $row->methodId], true);
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
        $url = $this->getUrl('form', 'admin_shipping');
        echo "mage.setUrl('{$url}').load()";
    }

    public function prepareCollection()
    {
        $filters = $this->getFilter()->getFilters();
        $this->getFilter()->clearFilters();
        $shipping = \Mage::getModel('Model\Shipping');
        $query = "SELECT * FROM `{$shipping->getTableName()}`";
        if ($filters) {
            $str = '';
            foreach ($filters as $fild => $value) {
                if ($value) {
                    $str .= "`{$fild}` LIKE '%{$value}%' ";
                }
            }
            $query = "SELECT * FROM `{$shipping->getTableName()}` WHERE {$str}";
            if ($str == '') {
                $query = "SELECT * FROM `{$shipping->getTableName()}`";
            }
        }
        $collection = $shipping->fetchAll($query);
        $this->setCollection($collection);
        $this->getFilter()->clearFilters();
        return $this;
    }

    public function getTitle()
    {
        return 'Manage Shipping';
    }
}
