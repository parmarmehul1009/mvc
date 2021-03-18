<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class Media extends \Block\Core\Edit
{
    protected $media = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/product/edit/tabs/media.php');
    }

    public function setMedia($media = null)
    {
        if ($media) {
            $this->media = $media;
        }
        $id = $this->getRequest()->getGet('id');
        $media = \Mage::getModel('Model\Product\Media');
        $query = "SELECT * FROM {$media->getTableName()} WHERE `productId` = '{$id}'";
        $media = $media->fetchAll($query);
        $this->media = $media;
        return $this;
    }

    public function getMedia()
    {
        if (!$this->media) {
            $this->setMedia();
        }
        return $this->media;
    }
}
