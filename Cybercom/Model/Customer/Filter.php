<?php

namespace Model\Customer;

\Mage::loadFileByClassName('Model\Customer\Session');
class Filter extends \Model\Customer\Session
{

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function getFilter()
    {
        return $this->filter;
    }

    public function clearFilter()
    {
        unset($this->filter);
        return $this;
    }
}
