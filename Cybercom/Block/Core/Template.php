<?php

namespace Block\Core;

class Template
{
    protected $controller = null;
    protected $template = null;
    protected $children = [];
    protected $message = null;
    protected $request = null;
    protected $url = null;
    protected $tabs = [];
    protected $defaultTab = null;

    public function __construct()
    {
        $this->setRequest();
        $this->setUrlObject();
    }

    function redirect($actionName = null, $connecterName = null, $params = null, $resetParam = false)
    {
        header("location:" . $this->geturl($actionName, $connecterName, $params, $resetParam));
        exit(0);
    }

    public function getUrl($actionName = null, $connecterName = null, $params = null, $resetParam = false)
    {
        return $this->getUrlObject()->getUrl($actionName, $connecterName, $params, $resetParam);
    }

    public function baseUrl($subUrl = null)
    {
        return $this->getUrlObject()->baseUrl($subUrl);
    }

    public function setUrlObject()
    {
        $this->url = \Mage::getModel('Model\Core\Url');
        return $this;
    }

    public function getUrlObject()
    {
        return \Mage::getModel('Model\Core\Url');
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

    public function setTemplate($template = null)
    {
        $this->template = $template;
        return $this;
    }

    public function getTemplate()
    {
        if (!$this->template) {
            $this->setTemplate();
        }
        return $this->template;
    }

    public function setController(\Controller\Core\Admin $controller)
    {
        $this->controller = $controller;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function toHtml()
    {
        ob_start();
        require $this->getTemplate();
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function setChildren(array $children = [])
    {
        $this->children = $children;
        return $this;
    }
    public function getChildren()
    {
        return $this->children;
    }
    public function addChild(\Block\Core\Template $child, $key = null)
    {
        if (!$key) {
            $key = get_class($child);
        }
        $this->children[$key] = $child;
        return $this;
    }
    public function getChild($key)
    {
        if (!array_key_exists($key, $this->children)) {
            return null;
        }
        return $this->children[$key];
    }
    public function removeChild($key)
    {
        if (array_key_exists($key, $this->children)) {
            unset($this->children[$key]);
        }
        return $this;
    }

    public function setMessage($message = null)
    {
        $this->message = \Mage::getModel('Model\Admin\Message');
    }

    public function getMessage()
    {
        if (!$this->message) {
            $this->setMessage();
        }
        return $this->message;
    }

    public function getBlock($className)
    {
        return \Mage::getBlock($className);
    }

    public function setDefaultTab($defaultTab)
    {
        $this->defaultTab = $defaultTab;
        return $this;
    }

    public function getDefaultTab()
    {
        return $this->defaultTab;
    }

    public function setTabs(array $tabs)
    {
        $this->tabs = $tabs;
        return $this;
    }

    public function removeTab($key)
    {
        if (array_key_exists($key, $this->tabs)) {
            $this->unsetTab($key);
        }
    }

    public function getTabs()
    {
        return $this->tabs;
    }

    public function addTab($key, array $tab)
    {
        $this->tabs[$key] = $tab;
        return $this;
    }

    public function unsetTab($key)
    {
        if (array_key_exists($key, $this->tabs)) {
            unset($this->tabs[$key]);
        }
    }



    // public function getTab($key)
    // {
    //     if (!array_key_exists($key, $this->tabs)) {
    //         return null;
    //     }
    //     return $this->tabs[$key];
    // }
}
