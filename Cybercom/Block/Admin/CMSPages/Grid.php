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
        $filters = $this->getFilter()->getFilters();
        $this->getFilter()->clearFilters();
        $cmspages = \Mage::getModel('Model\CMSPages');
        $query = "SELECT * FROM `{$cmspages->getTableName()}`";
        if ($filters) {
            $str = '';
            foreach ($filters as $fild => $value) {
                if ($value) {
                    $str .= "`{$fild}` LIKE '%{$value}%' ";
                }
            }
            $query = "SELECT * FROM `{$cmspages->getTableName()}` WHERE {$str}";
            if ($str == '') {
                $query = "SELECT * FROM `{$cmspages->getTableName()}`";
            }
        }
        $collection = $cmspages->fetchAll($query);
        $this->setCollection($collection);
        $this->getFilter()->clearFilters();
        return $this;
    }

    public function getTitle()
    {
        return 'Manage cmspages';
    }
}
