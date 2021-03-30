<?php

namespace Model\Core;

\Mage::loadFileByClassName('Model\Core\Session');
class Filter extends \Model\Core\Session
{

    public function setFilter($filters)
    {
        if (!$filters) {
            return false;
        }
        $filters = array_filter(array_map(function ($value) {
            $value = array_filter($value);
            return $value;
        }, $filters));

        $this->filters = $filters;
    }

    public function getFilter()
    {
        return $this->filters;
    }

    public function hasFilters()
    {
        if (!$this->filters) {
            return false;
        }
        return true;
    }

    public function getFilterValue($type, $key)
    {
        if (!$this->filters) {
            return null;
        }

        if (!array_key_exists($type, $this->filters)) {
            return null;
        }

        if (!array_key_exists($key, $this->filters[$type])) {
            return null;
        }
        return $this->filters[$type][$key];
    }

    public function clearFilter()
    {
        unset($this->filters);
        return $this;
    }
}
