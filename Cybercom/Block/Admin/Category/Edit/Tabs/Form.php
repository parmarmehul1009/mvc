<?php

namespace Block\Admin\Category\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');


class Form extends \Block\Core\Edit
{
    protected $categories = null;
    protected $categoriesOptions = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/category/edit/tabs/from.php');
    }

    public function getCategory()
    {
        return $this->getTableRow();
    }

    public function setCategoriesOptions()
    {
        $query = "SELECT `categoryId`,`name` FROM `{$this->getCategory()->getTableName()}`";
        $options = $this->getCategory()->getAdapter()->fetchPairs($query);
        $id = $this->getRequest()->getGet('id');
        $category = \Mage::getModel('Model\Category')->load($id);
        if ($category) {
            $pathId = $category->pathId;
            $query = "SELECT `categoryId`,`pathId` From `{$this->getCategory()->getTableName()}` WHERE pathId NOT LIKE '{$pathId}%' ORDER BY pathId ASC";
            $this->categoriesOptions = $this->getCategory()->getAdapter()->fetchPairs($query);
        } else {
            $query = "SELECT `categoryId`,`pathId` From `{$this->getCategory()->getTableName()}` ORDER BY pathId ASC";
            $this->categoriesOptions = $this->getCategory()->getAdapter()->fetchPairs($query);
        }
        if ($this->categoriesOptions) {
            foreach ($this->categoriesOptions as $categoryId => &$pathId) {
                $pathIds = explode('=', $pathId);
                foreach ($pathIds as $key => &$id) {
                    if (array_key_exists($id, $options)) {
                        $id = $options[$id];
                    }
                }
                $pathId = implode('/', $pathIds);
            }
        }
        $this->categoriesOptions = ['0' => 'Root Category'] + $this->categoriesOptions;
    }

    public function getCategoriesOptions()
    {
        if (!$this->categoriesOptions) {
            $this->setCategoriesOptions();
        }
        return $this->categoriesOptions;
    }
}
