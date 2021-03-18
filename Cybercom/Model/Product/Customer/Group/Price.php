<?php

namespace Model\Product\Customer\Group;

\Mage::loadFileByClassName('Model\Core\Table');

class Price extends \Model\Core\Table
{
    public function __construct()
    {
        $this->setPrimaryKey('entityId');
        $this->setTableName('product_customer_group_price');
    }
}
