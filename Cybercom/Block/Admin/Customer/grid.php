<?php

namespace Block\Admin\Customer;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareColumns()
    {
        $this->addColumn('customerId', [
            'field' => 'customerId',
            'label' => 'Customer Id',
            'type' => 'number',
        ]);

        $this->addColumn('firstName', [
            'field' => 'firstName',
            'label' => 'Customer firstName',
            'type' => 'text',
        ]);

        $this->addColumn('groupName', [
            'field' => 'groupName',
            'label' => 'Customer GroupName',
            'type' => 'text',
        ]);

        $this->addColumn('zipCode', [
            'field' => 'zipCode',
            'label' => 'Customer ZipCode',
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

        $url = $this->getUrl('form', 'admin_customer', ['id' => $row->customerId], true);
        echo "mage.setUrl('{$url}').load()";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl('delete', 'admin_customer', ['id' => $row->customerId], true);
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
        $url = $this->getUrl('form', 'admin_customer');
        echo "mage.setUrl('{$url}').load()";
    }

    public function prepareCollection()
    {
        $customer = \Mage::getModel('Model\Customer');
        $query = "SELECT COUNT(*) AS count FROM `{$customer->getTableName()}`;";
        $result = $customer->fetchRow($query);
        $this->getPager()->setCurrentPage($_GET['p']);
        $this->getPager()->setRecordsPerPage(5);
        $this->getPager()->setTotalRecord($result->count);
        $this->getPager()->calculate();
        $start = ($this->getPager()->getCurrentPage() - 1) * $this->getPager()->getRecordsPerPage();
        $query = "SELECT C.*,CG.name AS groupName,CA.zipCode FROM customer as C LEFT JOIN customer_group AS CG ON C.groupId = CG.groupId LEFT JOIN customer_address AS CA ON CA.customerId = C.customerId AND CA.addressType = 'Billing'";;
        if ($this->getFilter()->hasFilters()) {
            $query .= 'WHERE 1 = 1';
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                foreach ($filters as $key => $value) {
                    if ($key == 'groupName') {
                        $query .= " AND (CG.name LIKE '%{$value}%')";
                    }
                    if ($key == 'zipCode') {
                        $query .= " AND (CA.{$key} LIKE '%{$value}%') ";
                    }
                    if ($key != 'groupName' && $key != 'zipCode') {
                        $query .= " AND (C.{$key} LIKE '%{$value}%') ";
                    }
                    $query .= " AND (`{$key}` LIKE '%{$value}%')";
                }
            }
        }
        $query .= "LIMIT {$start}, {$this->getPager()->getRecordsPerPage()}";
        $collection = $customer->fetchAll($query);
        $this->setCollection($collection);
        return $this;
    }

    public function getApplyFilterUrl()
    {
        $url = $this->getUrl('filter', 'admin_customer', null, true);
        echo "mage.setForm(this).setUrl('{$url}').load()";
    }

    public function getTitle()
    {
        return 'Manage Customer';
    }
}
