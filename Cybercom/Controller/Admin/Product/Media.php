<?php

namespace Controller\Admin\Product;

use Exception;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Media extends \Controller\Core\Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $layout = $this->getlayout();
        $this->renderLayout();
    }

    public function updateAction()
    {
        $mediaData = $this->getRequest()->getPost('media');
        $productId = $this->getRequest()->getGet('id');
        $media = \Mage::getModel('Model\Product\Media');
        $query = "SELECT * FROM `{$media->getTableName()}` WHERE productId = '{$productId}'";
        $medias = $media->fetchAll($query);
        if ($medias) {
            foreach ($medias->getData() as $media) {
                $media->small = 0;
                $media->thumb = 0;
                $media->base = 0;
                if ($mediaData['small'] == $media->mediaId) {
                    $media->small = 1;
                }
                if ($mediaData['thumb'] == $media->mediaId) {
                    $media->thumb = 1;
                }
                if ($mediaData['base'] == $media->mediaId) {
                    $media->base = 1;
                }
                if (array_key_exists($media->mediaId, $mediaData['data'])) {
                    $media->label = $mediaData['data'][$media->mediaId]['lebel'];
                    $media->gallery = 0;
                    if (array_key_exists('gallery', $mediaData['data'][$media->mediaId])) {
                        $media->gallery = 1;
                    }
                }
                $media->save();
            }
        }
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function removeAction()
    {
        $mediaData = $this->getRequest()->getPost('media');
        $productId = $this->getRequest()->getGet('id');
        $media = \Mage::getModel('Model\Product\Media');
        $query = "SELECT * FROM `{$media->getTableName()}` WHERE productId = '{$productId}'";
        $medias = $media->fetchAll($query);
        if ($medias) {
            foreach ($medias->getData() as $media) {
                if (array_key_exists($media->mediaId, $mediaData['remove'])) {
                    $media->load($media->mediaId);
                    $path = \Mage::getbaseDir('skin\admin\product\image\\') . $media->image;
                    unlink($path);
                    $media->delete();
                }
            }
        }
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function testAction()
    {
        $product = \Mage::getBlock('Model\Product');
        $productId = $this->getRequest()->getGet('id');
        try {
            if (!$productId) {
                throw new \Exception("Id is not Available.", 1);
            }
            if (!$product = $product->load($productId)) {
                throw new \Exception("No Product For Given Id", 1);
            }
            if (array_key_exists('file', $_FILES)) {
                $file = $_FILES['file']['name'];
                if ($file) {
                    $temp_name = $_FILES['file']['tmp_name'];
                    $filePath = \Mage::getbaseDir('skin\admin\product\image\\');
                    $fileName = time() . $file;
                    move_uploaded_file($temp_name, $filePath . $fileName);
                    $media = \Mage::getModel('Model\Product\Media');
                    $mediaData = ['image' => $fileName, 'productId' => $productId];
                    $media->setData($mediaData);
                    $media->save();
                }
            }
        } catch (Exception $e) {
        }
        $edit = \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product)->toHtml();
        $this->makeResponse($edit);
    }
}
