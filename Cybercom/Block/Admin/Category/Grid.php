<?php

namespace Block\Admin\Category;

\Mage::loadFileByClassName('Block\Core\Grid');

class Grid extends \Block\Core\Grid
{
    protected $categoriesOptions = [];
    public function prepareColumns()
    {
        $this->addColumn('categoryId', [
            'field' => 'categoryId',
            'label' => 'Category Id',
            'type' => 'number',
        ]);

        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'Category Name',
            'type' => 'text',
        ]);

        // $this->addColumn('image', [
        //     'field' => 'image',
        //     'label' => 'Image',
        //     'type' => 'image',
        // ]);

        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'category status',
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
        $url = $this->getUrl('form', 'admin_category', ['id' => $row->categoryId], true);
        echo "mage.setUrl('{$url}').load()";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl('delete', 'admin_category', ['id' => $row->categoryId], true);
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
        if ($field == 'name') {
            return $this->getName($row);
        }
        return $row->$field;
    }


    public function getAddNewUrl()
    {

        $url = $this->getUrl('form', 'admin_category');
        echo "mage.setUrl('{$url}').load()";
    }


    public function prepareCollection()
    {
        $filters = $this->getFilter()->getFilters();
        $this->getFilter()->clearFilters();
        $this->getPager()->setCurrentPage(1);
        $this->getPager()->setRecordsPerPage(5);
        $this->getPager()->calculate();
        $start = ($this->getPager()->getCurrentPage() - 1) * $this->getPager()->getRecordsPerPage();
        $category = \Mage::getModel('Model\category');
        $query = "SELECT * FROM `{$category->getTableName()}` LIMIT {$start},{$this->getPager()->getRecordsPerPage()}";
        if ($filters) {
            $str = '';
            foreach ($filters as $fild => $value) {
                if ($value) {
                    $str .= " AND `{$fild}` LIKE '%{$value}%' ";
                }
            }
            $query = "SELECT * FROM `{$category->getTableName()}` WHERE 1 = 1 {$str} LIMIT {$start},{$this->getPager()->getRecordsPerPage()}";
            if ($str == '') {
                $query = "SELECT * FROM `{$category->getTableName()}` LIMIT {$start},{$this->getPager()->getRecordsPerPage()}";
            }
        }
        $collection = $category->fetchAll($query);
        $this->setCollection($collection);
        return $this;
    }

    public function getTitle()
    {
        return 'Manage Category';
    }

    public function getName($category)
    {
        $categoryModel = \Mage::getModel('Model\Category');
        if (!$this->categoriesOptions) {
            $query = "SELECT `categoryId`,`name` FROM `{$categoryModel->getTableName()}`";
            $this->categoriesOptions = $categoryModel->getAdapter()->fetchPairs($query);
        }

        $pathIds = explode('=', $category->pathId);
        foreach ($pathIds as $key => &$id) {
            if (array_key_exists($id, $this->categoriesOptions)) {
                $id = $this->categoriesOptions[$id];
            }
        }
        $name = implode('/', $pathIds);
        return $name;
    }

    public function getApplyFilterUrl()
    {
        $url = $this->getUrl('filter', 'admin_category', null, true);
        echo "mage.setForm(this).setUrl('{$url}').load()";
    }
}
// http://localhost/myProject/practice/index.php?c=admin_dashboard&a=index&p=4