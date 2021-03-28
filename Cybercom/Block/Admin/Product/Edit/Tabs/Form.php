<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class Form extends \Block\Core\Edit
{
    protected $categoriesOptions = [];
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/product/edit/tabs/form.php');
    }

    public function getCategory()
    {
        return \Mage::getModel('Model\Category');
    }

    public function setCategoriesOptions()
    {
        $query = "SELECT `categoryId`,`name` FROM `{$this->getCategory()->getTableName()}`";
        $options = $this->getCategory()->getAdapter()->fetchPairs($query);

        $query = "SELECT `categoryId`,`pathId` From `{$this->getCategory()->getTableName()}` ORDER BY pathId ASC";
        $this->categoriesOptions = $this->getCategory()->getAdapter()->fetchPairs($query);
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
    }

    public function getCategoriesOptions()
    {
        if (!$this->categoriesOptions) {
            $this->setCategoriesOptions();
        }
        return $this->categoriesOptions;
    }

    public function getCategorys()
    {
        $product = $this->getTableRow();
        if ($product->productId) {
            $product_category = \Mage::getModel('Model\Product\Category');
            $query = "SELECT * FROM `{$product_category->getTableName()}` WHERE `productId` = {$product->productId}";
            $categorys = $product_category->fetchAll($query);
            return $categorys;
        }
    }
}
