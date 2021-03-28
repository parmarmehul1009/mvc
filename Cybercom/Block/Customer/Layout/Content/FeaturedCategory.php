<?php

namespace Block\Customer\Layout\Content;

\Mage::loadFileByClassName('Block\Core\Template');
class FeaturedCategory extends \Block\Core\Template
{
    protected $featuredCategorys = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/customer/layout/content/featurecategory.php');
    }

    public function setFeaturedCategorys()
    {
        $category = \Mage::getModel('Model\Category');
        $query = "SELECT * FROM '$category->getTableName()' WHERE `featured` = 1";
        $this->featuredCategorys = $category->fetchAll($query);
        return $this;
    }

    public function getFeaturedCategorys()
    {
        if (!$this->featuredCategorys) {
            $this->setFeaturedCategorys();
        }
        return $this->featuredCategorys;
    }

    public function getImage()
    {
        $media = \Mage::getModel('Model\Category\Media');
    }
}
