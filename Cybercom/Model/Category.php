<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Category extends \Model\Core\Table
{

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    public function __construct()
    {
        // parent::__construct();
        $this->setPrimaryKey('categoryId');
        $this->setTableName('category');
    }

    public function getStatusOption()
    {
        return [
            self::STATUS_DISABLE => 'Disable',
            self::STATUS_ENABLE => 'Enable'
        ];
    }


    public function updatePathId()
    {
        if (!$this->parentId) {
            $pathId = $this->categoryId;
        } else {
            $parent = \Mage::getModel('Model\Category')->load($this->parentId);
            if (!$parent) {
                throw new \Exception("Unable to load parent", 1);
            }
            $pathId = $parent->pathId . '=' . $this->categoryId;
        }
        $this->pathId = $pathId;
        return $this->save();
    }

    public function updateChildrenPathIds($categoryPathId, $Id = null, $parentId = null)
    {
        $categoryPathId = $categoryPathId . '=';
        $query = "SELECT * FROM `{$this->getTableName()}` WHERE pathId LIKE '{$categoryPathId}%' ORDER BY `pathId` ASC";
        $categories = $this->fetchAll($query);
        if ($categories) {
            foreach ($categories->getData() as  $row) {
                if ($parentId != null) {
                    if ($row->parentId == $Id) {
                        $row->parentId = $parentId;
                    }
                }
                $row->updatePathId();
            }
        }
    }
}
