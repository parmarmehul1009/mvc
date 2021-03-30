<?php

namespace Model\Core;

class Url
{
    protected $request = null;

    public function __construct()
    {
        $this->setRequest();
    }

    public function setRequest()
    {
        $this->request = \Mage::getModel('Model\Core\Request');
        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    function getUrl($actionName = NULL, $connecterName = NULL, $params = null, $resetParam = false)
    {
        $final = $this->getRequest()->getGet();
        if (!$resetParam) {
            $final = [];
        }
        if ($actionName == NULL) {
            $actionName = $this->getRequest()->getGet('a');
        }
        if ($connecterName == NULL) {
            $connecterName = $this->getRequest()->getGet('c');
        }
        $final['c'] = $connecterName;
        $final['a'] = $actionName;
        if (is_array($params)) {
            $final = array_merge($final, $params);
        }
        $queryString = http_build_query($final);
        return "http://localhost/Advance%20php/Practice/Cybercom/index.php?p=1&{$queryString}";
    }

    public function baseUrl($subUrl = null)
    {
        $url = "http://localhost/Advance%20php/Practice/Cybercom/";
        if ($subUrl) {
            $url .= $subUrl;
        }
        return $url;
    }
}
