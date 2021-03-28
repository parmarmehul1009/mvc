<?php

namespace Block\Admin\Admin;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareColumns()
    {
        $this->addColumn('adminId', [
            'field' => 'adminId',
            'label' => 'Admin Id',
            'type' => 'number',
        ]);

        $this->addColumn('name', [
            'field' => 'userName',
            'label' => 'User Name',
            'type' => 'text',
        ]);

        $this->addColumn('password', [
            'field' => 'password',
            'label' => 'admin Password',
            'type' => 'text',
        ]);

        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'admin status',
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

        $url = $this->getUrl('form', 'admin_admin', ['id' => $row->adminId], true);
        echo "mage.setUrl('{$url}').load()";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl('delete', 'admin_admin', ['id' => $row->adminId], true);
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
        $url = $this->getUrl('form', 'admin_admin');
        echo "mage.setUrl('{$url}').load()";
    }


    public function prepareCollection()
    {
        $filters = $this->getFilter()->getFilters();
        $this->getFilter()->clearFilters();
        $admin = \Mage::getModel('Model\Admin');
        $query = "SELECT * FROM `{$admin->getTableName()}`";
        if ($filters) {
            $str = '';
            foreach ($filters as $fild => $value) {
                if ($value) {
                    $str .= "`{$fild}` LIKE '%{$value}%' ";
                }
            }
            $query = "SELECT * FROM `{$admin->getTableName()}` WHERE {$str}";
            if ($str == '') {
                $query = "SELECT * FROM `{$admin->getTableName()}`";
            }
        }
        $collection = $admin->fetchAll($query);
        $this->setCollection($collection);
        $this->getFilter()->clearFilters();
        return $this;
    }

    public function getTitle()
    {
        return 'Manage Admin';
    }

    public function getApplyFilterUrl()
    {
        $url = $this->getUrl('filter', 'admin_admin', null, true);
        echo "mage.setForm(this).setUrl('{$url}').load()";
    }
}
