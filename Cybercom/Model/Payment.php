<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Payment extends \Model\Core\Table
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    public function __construct()
    {
        $this->setPrimaryKey('methodId');
        $this->setTableName('payment');
    }

    public function getStatusOption()
    {
        return [
            self::STATUS_DISABLE => 'Disable',
            self::STATUS_ENABLE => 'Enable'
        ];
    }
}
