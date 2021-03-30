<?php

namespace Block\Admin\Brand;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareColumns()
    {
        $this->addColumn('brandId', [
            'field' => 'brandId',
            'label' => 'Brand Id',
            'type' => 'number',
        ]);

        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'Brand Name',
            'type' => 'text',
        ]);

        $this->addColumn('image', [
            'field' => 'image',
            'label' => 'Image',
            'type' => 'image',
        ]);

        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'Brand status',
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
        $url = $this->getUrl('form', 'admin_brand', ['id' => $row->brandId], true);
        echo "mage.setUrl('{$url}').load()";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl('delete', 'admin_brand', ['id' => $row->brandId], true);
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

    public function getFildValue($row, $field)
    {
        if ($field == 'image') {
            return "media\brand\\" . $row->$field;
        }
        return $row->$field;
    }


    public function getAddNewUrl()
    {

        $url = $this->getUrl('form', 'admin_brand');
        echo "mage.setUrl('{$url}').load()";
    }


    public function prepareCollection()
    {
        $brand = \Mage::getModel('Model\Brand');
        $query = "SELECT COUNT(*) AS count FROM `{$brand->getTableName()}`;";
        $result = $brand->fetchRow($query);
        $this->getPager()->setCurrentPage($_GET['p']);
        $this->getPager()->setRecordsPerPage(5);
        $this->getPager()->setTotalRecord($result->count);
        $this->getPager()->calculate();
        $start = ($this->getPager()->getCurrentPage() - 1) * $this->getPager()->getRecordsPerPage();
        $query = "SELECT * FROM `{$brand->getTableName()}`";
        if ($this->getFilter()->hasFilters()) {
            $query .= 'WHERE 1 = 1';
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                foreach ($filters as $key => $value) {
                    $query .= " AND (`{$key}` LIKE '%{$value}%')";
                }
            }
        }
        $query .= "LIMIT {$start}, {$this->getPager()->getRecordsPerPage()}";
        $collection = $brand->fetchAll($query);
        $this->setCollection($collection);
        return $this;
    }

    public function getTitle()
    {
        return 'Manage brand';
    }

    public function getApplyFilterUrl()
    {
        $url = $this->getUrl('filter', 'admin_brand', null, true);
        echo "mage.setForm(this).setUrl('{$url}').load()";
    }
}
