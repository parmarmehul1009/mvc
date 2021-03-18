<?php

namespace Model\Product;

\Mage::loadFileByClassName('Model\Core\Table');

class Media extends \Model\Core\Table
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    public function __construct()
    {
        // parent::__construct();
        $this->setTableName('media');
        $this->setPrimaryKey('mediaId');
    }

    public function getStatusOption()
    {
        return [
            self::STATUS_ENABLE => 'Enable',
            self::STATUS_DISABLE => 'Disable'
        ];
    }
}
