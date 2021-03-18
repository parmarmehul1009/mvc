<?php

namespace Controller\Core;

\Mage::loadFileByClassName('Controller\Core\Abstracts');
class Admin extends \Controller\Core\Abstracts
{
    public function setLayout(\Block\Core\Layout $layout = null)
    {
        if (!$layout) {
            $layout  = \Mage::getBlock('Block\Admin\Layout');
        }
        if (!$layout instanceof \Block\Admin\Layout) {
            throw new \Exception("Must be a instanceof \Block\Admin\Layout");
        }
        $this->layout = $layout;
        return $this;
    }

    public function setMessage($message = null)
    {
        $this->message = \Mage::getModel('Model\Admin\Message');
        return $this;
    }
}
