<?php

namespace Model\Admin;

\Mage::loadFileByClassName('Model\Admin\Session');
class Filter extends \Model\Admin\Session
{

    public function setFilters($filter)
    {
        $this->filter = $filter;
    }

    public function getFilters()
    {
        return $this->filter;
    }

    public function clearFilters()
    {
        unset($this->filter);
        return $this;
    }
}
