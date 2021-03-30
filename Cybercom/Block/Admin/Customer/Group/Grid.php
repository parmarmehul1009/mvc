<?php

namespace Block\Admin\Customer\Group;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareColumns()
    {
        $this->addColumn('groupId', [
            'field' => 'groupId',
            'label' => 'Customer Group Id',
            'type' => 'number',
        ]);

        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'Customer Group Name',
            'type' => 'text',
        ]);


        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'Customer Group status',
            'type' => 'enum',
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

        $url = $this->getUrl('form', 'admin_customer_group', ['id' => $row->groupId], true);
        echo "mage.setUrl('{$url}').load()";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl('delete', 'admin_customer_group', ['id' => $row->groupId], true);
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
        $url = $this->getUrl('form', 'admin_customer_group');
        echo "mage.setUrl('{$url}').load()";
    }

    public function getApplyFilterUrl()
    {
        $url = $this->getUrl('filter', 'admin_customer_group', null, true);
        echo "mage.setForm(this).setUrl('{$url}').load()";
    }

    public function prepareCollection()
    {
        $customerGroup = \Mage::getModel('Model\Customer\Group');
        $query = "SELECT * FROM `{$customerGroup->getTableName()}`";
        if ($this->getFilter()->hasFilters()) {
            $query .= 'WHERE 1 = 1';
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                foreach ($filters as $key => $value) {
                    $query .= " AND (`{$key}` LIKE '%{$value}%')";
                }
            }
        }
        $collection = $customerGroup->fetchAll($query);
        $this->setCollection($collection);
        return $this;
    }

    public function getTitle()
    {
        return 'Manage CustomerGroup';
    }
}
