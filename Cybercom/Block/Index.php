<?php

namespace Block\Home;

use Block\Core\Template;

class Index extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate('./View/home/index.php');
    }
}
