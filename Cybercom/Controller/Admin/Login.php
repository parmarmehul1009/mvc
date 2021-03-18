<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Login extends \Controller\Core\Admin
{


    public function indexAction()
    {
        $layout = $this->getlayout();
        $layout->setTemplate('View/core/layout/index.php');
        $this->renderLayout();
    }
}
