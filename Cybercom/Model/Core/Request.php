<?php

namespace Model\Core;

class Request
{
    public function getPost($key = null, $value = null)
    {
        if (!$key) {
            return $_POST;
        }
        if (!array_key_exists($key, $_POST)) {
            return $value;
        }
        return $_POST[$key];
    }
    public function getGet($key = null, $value = null)
    {
        if (!$key) {
            return $_GET;
        }
        if (!array_key_exists($key, $_GET)) {
            return $value;
        }
        return $_GET[$key];
    }
    public function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return false;
        }
        return true;
    }

    public function getActionName()
    {
        return $this->getGet('a', 'index');
    }

    public function getControllerName()
    {
        return $this->getGet('c', 'admin_index');
    }
}
