<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Brand extends \Model\Core\Table
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    public function __construct()
    {
        $this->setPrimaryKey('brandId');
        $this->setTableName('brand');
    }

    public function getStatusOption()
    {
        return [
            self::STATUS_DISABLE => 'Disable',
            self::STATUS_ENABLE => 'Enable'
        ];
    }
}
