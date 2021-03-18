<?php

namespace Model\Attribute;

\Mage::loadFileByClassName('Model\Core\Table');

class Option extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setPrimaryKey('optionId');
        $this->setTableName('attribute_option');
    }
}
