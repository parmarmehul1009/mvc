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
        $shipping = \Mage::getModel('Model\Shipping');
        $query = "SELECT COUNT(*) AS count FROM `{$shipping->getTableName()}`;";
        $result = $shipping->fetchRow($query);
        $this->getPager()->setCurrentPage($_GET['p']);
        $this->getPager()->setRecordsPerPage(5);
        $this->getPager()->setTotalRecord($result->count);
        $this->getPager()->calculate();
        $start = ($this->getPager()->getCurrentPage() - 1) * $this->getPager()->getRecordsPerPage();
        $query = "SELECT * FROM `{$shipping->getTableName()}`";
        if ($this->getFilter()->hasFilters()) {
            $query .= 'WHERE 1 = 1';
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                foreach ($filters as $key => $value) {
                    $query .= " AND (`{$key}` LIKE '%{$value}%')";
                }
            }
        }
        $query .= "LIMIT {$start}, {$this->getPager()->getRecordsPerPage()}";
        $collection = $shipping->fetchAll($query);
        $this->setCollection($collection);
        return $this;
    }

    public function getApplyFilterUrl()
    {
        $url = $this->getUrl('filter', 'admin_shipping', null, true);
        echo "mage.setForm(this).setUrl('{$url}').load()";
    }

    public function getTitle()
    {
        return 'Manage Shipping';
    }
}
