<?php

namespace Controller\Core;

class Abstracts
{
    protected $layout = null;
    protected $request = null;
    protected $message = null;
    protected $filter = null;

    public function __construct()
    {
        $this->setRequest();
    }
    public function setRequest()
    {
        $this->request = \Mage::getModel('Model\Core\Request');
        return $this;
    }

    public function setLayout(\Block\Core\Layout $layout = null)
    {
        if (!$layout) {
            $layout  = \Mage::getBlock('Block\Core\Layout');
        }
        $this->layout = $layout;
        return $this;
    }

    public function getlayout()
    {
        if (!$this->layout) {
            $this->setLayout();
        }
        return $this->layout;
    }

    public function renderLayout()
    {
        echo ($this->getlayout()->toHtml());
    }

    public function getRequest()
    {
        return $this->request;
    }
    function redirect($actionName = null, $connecterName = null, $params = null, $resetParam = false)
    {
        header("location:" . $this->getUrl($actionName, $connecterName, $params, $resetParam));
        exit(0);
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
    // return "http://localhost/Advance%20php/Practice/Cybercom/index.php?{$queryString}";
    public function setMessage($message = null)
    {
        $this->message = \Mage::getModel('Model\Core\Message');
        return $this;
    }


    public function getMessage()
    {
        if (!$this->message) {
            $this->setMessage();
        }
        return $this->message;
    }

    public function setFilter($filter = null)
    {
        $this->filter = \Mage::getModel('Model\Core\Filter');
        return $this;
    }

    public function getFilter()
    {
        if (!$this->filter) {
            $this->setFilter();
        }
        return $this->filter;
    }

    public function makeResponse($content = null, $left = null, $right = null)
    {
        $response = [
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $content,
                ],
                [
                    'selector' => '#leftHtml',
                    'html' => $left,
                ],
                [
                    'selector' => '#messageHtml',
                    'html' => \Mage::getBlock('Block\Core\Layout\Message')->toHtml(),
                ],
                [
                    'selector' => '#rigthHtml',
                    'html' => $right,
                ]
            ]
        ];
        header('Content-Type:application/json charset=UTF-8');
        echo json_encode($response);
    }
}
