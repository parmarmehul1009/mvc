<?php

namespace Block\Admin\CMSPages;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareColumns()
    {
        $this->addColumn('pageId', [
            'field' => 'pageId',
            'label' => 'Page Id',
            'type' => 'number',
        ]);

        $this->addColumn('title1', [
            'field' => 'title1',
            'label' => 'Page Title',
            'type' => 'text',
        ]);

        $this->addColumn('content', [
            'field' => 'content',
            'label' => 'Page Content',
            'type' => 'text',
        ]);

        $this->addColumn('identifier', [
            'field' => 'identifier',
            'label' => 'Page Identifier',
            'type' => 'text',
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

        $url = $this->getUrl('form', 'admin_CMSPages', ['id' => $row->pageId], true);
        echo "mage.setUrl('{$url}').load()";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl('delete', 'admin_CMSPages', ['id' => $row->pageId], true);
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
        $url = $this->getUrl('form', 'admin_CMSPages');
        echo "mage.setUrl('{$url}').load()";
    }

    public function prepareCollection()
    {
        $cmspages = \Mage::getModel('Model\CMSPages');
        $query = "SELECT COUNT(*) AS count FROM `{$cmspages->getTableName()}`;";
        $result = $cmspages->fetchRow($query);
        $this->getPager()->setCurrentPage($_GET['p']);
        $this->getPager()->setRecordsPerPage(5);
        $this->getPager()->setTotalRecord($result->count);
        $this->getPager()->calculate();
        $start = ($this->getPager()->getCurrentPage() - 1) * $this->getPager()->getRecordsPerPage();
        $query = "SELECT * FROM `{$cmspages->getTableName()}`";
        if ($this->getFilter()->hasFilters()) {
            $query .= 'WHERE 1 = 1';
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                foreach ($filters as $key => $value) {
                    $query .= " AND (`{$key}` LIKE '%{$value}%')";
                }
            }
        }
        $query .= "LIMIT {$start}, {$this->getPager()->getRecordsPerPage()}";
        $collection = $cmspages->fetchAll($query);
        $this->setCollection($collection);
        return $this;
    }

    public function getApplyFilterUrl()
    {
        $url = $this->getUrl('filter', 'admin_CMSPages', null, true);
        echo "mage.setForm(this).setUrl('{$url}').load()";
    }

    public function getTitle()
    {
        return 'Manage cmspages';
    }
}
