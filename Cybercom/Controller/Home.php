<?php

namespace Controller;

\Mage::loadFileByClassName('Controller\Core\Customer');

class Home extends \Controller\Core\Customer
{
    public function indexAction()
    {
        $layout = $this->getlayout();
        $this->renderLayout();
    }
}
