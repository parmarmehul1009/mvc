<?php

namespace Model\Core;

\Mage::loadFileByClassName('Model\Core\Session');
class Message extends \Model\Core\Session
{

    public function setSuccess($message)
    {
        $this->success = $message;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function setFailure($message)
    {
        $this->failure = $message;
    }

    public function getfailure()
    {
        return $this->failure;
    }

    public function setNotice($message)
    {
        $this->notice = $message;
    }
    public function getNotice()
    {
        return $this->notice;
    }

    public function clearFailure()
    {
        unset($this->failure);
        return $this;
    }
    public function clearSuccess()
    {
        unset($this->success);
        return $this;
    }
    public function clearNotice()
    {
        unset($this->notice);
        return $this;
    }
}
