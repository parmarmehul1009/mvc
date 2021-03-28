<?php

namespace Controller\Core;

\Mage::loadFileByClassName('Controller\Core\Abstracts');
class Customer extends \Controller\Core\Abstracts
{
    public function setLayout(\Block\Core\Layout $layout = null)
    {
        if (!$layout) {
            $layout  = \Mage::getBlock('Block\Customer\Layout');
        }
        if (!$layout instanceof \Block\Customer\Layout) {
            throw new \Exception("Must be a instanceof \Block\Customer\Layout");
        }
        $this->layout = $layout;
        return $this;
    }

    public function setMessage($message = null)
    {
        $this->message = \Mage::getModel('Model\Customer\Message');
        return $this;
    }

    public function setFilter($filter = null)
    {
        $this->filter = \Mage::getModel('Model\Customer\Filter');
        return $this;
    }
}
