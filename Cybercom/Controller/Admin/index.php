<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Index extends \Controller\Core\Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $layout = $this->getlayout();
        $this->renderLayout();
    }


    public function contentAction()
    {
        $index = \Mage::getBlock('Block\Admin\Dashbord\index')->toHtml();
        $this->makeResponse($index);
    }
}
