<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');

class Attribute extends \Block\Core\Edit
{
    protected $attributes = null;
    protected $options = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/product/edit/tabs/attribute.php');
    }

    public function setAttributes($attributes = null)
    {
        if ($attributes) {
            $this->attribute = $attributes;
        }
        $attribute = \Mage::getModel('Model\Attribute');
        $query = "SELECT * FROM {$attribute->getTableName()} WHERE `entityTypeId` = 'product' ORDER BY `sortOrder` ASC";
        $this->attributes = $attribute->fetchAll($query);
        return $this;
    }

    public function getAttributes()
    {
        if (!$this->attributes) {
            $this->setAttributes();
        }
        return $this->attributes;
    }
}
