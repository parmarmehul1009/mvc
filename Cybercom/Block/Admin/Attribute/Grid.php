<?php

namespace Block\Admin\Attribute;

\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
    protected $attributes = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/attribute/grid.php');
    }

    public function setAttributes($attributes = null)
    {
        if ($attributes) {
            $this->attributes = $attributes;
            return $this;
        }
        $attribute = \Mage::getModel('Model\Attribute');
        $attributes = $attribute->fetchAll();
        $this->attributes = $attributes;
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
