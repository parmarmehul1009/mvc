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
        $filters = $this->getFilter()->getFilters();
        $this->getFilter()->clearFilters();
        $customer = \Mage::getModel('Model\Customer');
        $query = $query = "SELECT C.*,CG.name AS groupName,CA.zipCode FROM customer as C LEFT JOIN customer_group AS CG ON C.groupId = CG.groupId LEFT JOIN customer_address AS CA ON CA.customerId = C.customerId AND CA.addressType = 'Billing'";;
        if ($filters) {
            $str = '';
            foreach ($filters as $field => $value) {
                if ($value) {
                    if ($field == 'groupName') {
                        $str .= "CG.name LIKE '%{$value}%' ";
                    }
                    if ($field == 'zipCode') {
                        $str .= "CA.{$field} LIKE '%{$value}%' ";
                    }
                    if ($field != 'groupName' && $field != 'zipCode') {
                        $str .= "C.{$field} LIKE '%{$value}%' ";
                    }
                }
            }
            $query = "SELECT C.*,CG.name AS groupName,CA.zipCode FROM customer as C LEFT JOIN customer_group AS CG ON C.groupId = CG.groupId LEFT JOIN customer_address AS CA ON CA.customerId = C.customerId AND CA.addressType = 'Billing' WHERE {$str}";
            if ($str == '') {
                $query = "SELECT C.*,CG.name AS groupName,CA.zipCode FROM customer as C LEFT JOIN customer_group AS CG ON C.groupId = CG.groupId LEFT JOIN customer_address AS CA ON CA.customerId = C.customerId AND CA.addressType = 'Billing'";
            }
        }
        $collection = $customer->fetchAll($query);
        $this->setCollection($collection);
        $this->getFilter()->clearFilters();
        return $this;
    }

    public function getTitle()
    {
        return 'Manage Customer';
    }
}
