<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class CMSPages extends \Model\Core\Table
{
    const STATUS_DISABLE = 1;
    const STATUS_ENABLE = 0;

    public function __construct()
    {
        $this->setTableName('cms_page');
        $this->setPrimaryKey('pageId');
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_DISABLE => 'Disable',
            self::STATUS_ENABLE => 'Enable',
        ];
    }
}
