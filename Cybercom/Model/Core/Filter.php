<?php

namespace Model\Core;

\Mage::loadFileByClassName('Model\Core\Session');
class Filter extends \Model\Core\Session
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
