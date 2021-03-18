<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Admin extends \Model\Core\Table
{

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    public function __construct()
    {
        $this->setPrimaryKey('adminId');
        $this->setTableName('admin');
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_DISABLE => 'Disable',
            self::STATUS_ENABLE => 'Enable'
        ];
    }
}
