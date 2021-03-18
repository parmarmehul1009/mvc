<?php

namespace Block\Admin\CMSPages;

\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template
{
    protected $cmsPages = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/cmspages/grid.php');
    }

    public function setCmsPages($cmsPages = null)
    {
        if ($cmsPages) {
            $this->cmsPages = $cmsPages;
        }
        $cmsPage  = \Mage::getModel('Model\CMSPages');
        $cmsPages = $cmsPage->fetchAll();
        $this->cmsPages = $cmsPages;
        return $this;
    }

    public function getCmsPages()
    {
        if (!$this->cmsPages) {
            $this->setCmsPages();
        }
        return $this->cmsPages;
    }
}
