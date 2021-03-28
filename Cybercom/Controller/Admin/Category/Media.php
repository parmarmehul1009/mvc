<?php

namespace Controller\Admin\Category;

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
        $categoryId = $this->getRequest()->getGet('id');
        $media = \Mage::getModel('Model\Category\Media');
        $query = "SELECT * FROM `{$media->getTableName()}` WHERE categoryId = '{$categoryId}'";
        $medias = $media->fetchAll($query);

        if ($medias) {
            foreach ($medias->getData() as $media) {
                $media->icone = 0;
                $media->base = 0;
                if (array_key_exists('icone', $mediaData)) {
                    if ($mediaData['icone'] == $media->mediaId) {
                        $media->icone = 1;
                    }
                }
                if (array_key_exists('base', $mediaData)) {
                    if ($mediaData['base'] == $media->mediaId) {
                        $media->base = 1;
                    }
                }
                if (array_key_exists($media->mediaId, $mediaData['data'])) {
                    $media->label = $mediaData['data'][$media->mediaId]['lebel'];
                }
                $media->banner = 0;
                if (array_key_exists('banner', $mediaData)) {
                    if (array_key_exists($media->mediaId, $mediaData['banner'])) {
                        $media->banner = 1;
                    }
                }
                if (array_key_exists('active', $mediaData)) {
                    $media->active = $mediaData['active'][$media->mediaId];
                }
                $media->save();
            }
        }
        $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function removeAction()
    {
        $mediaData = $this->getRequest()->getPost('media');
        $categoryId = $this->getRequest()->getGet('id');
        $media = \Mage::getModel('Model\category\Media');
        $query = "SELECT * FROM `{$media->getTableName()}` WHERE categoryId = '{$categoryId}'";
        $medias = $media->fetchAll($query);
        if ($medias) {
            foreach ($medias->getData() as $media) {
                if (array_key_exists($media->mediaId, $mediaData['remove'])) {
                    $media->load($media->mediaId);
                    $path = \Mage::getbaseDir('skin\admin\category\image\\') . $media->image;
                    unlink($path);
                    $media->delete();
                }
            }
        }
        $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function testAction()
    {
        $category = \Mage::getBlock('Model\Category');
        $categoryId = $this->getRequest()->getGet('id');
        try {
            if (!$categoryId) {
                throw new \Exception("Id is not Available.", 1);
            }
            if (!$category = $category->load($categoryId)) {
                throw new \Exception("No category For Given Id", 1);
            }
            if (array_key_exists('file', $_FILES)) {
                $file = $_FILES['file']['name'];
                if ($file) {
                    $temp_name = $_FILES['file']['tmp_name'];
                    $filePath = \Mage::getbaseDir('skin\admin\category\image\\');
                    $fileName = time() . $file;
                    move_uploaded_file($temp_name, $filePath . $fileName);
                    $media = \Mage::getModel('Model\Category\Media');
                    $mediaData = ['image' => $fileName, 'categoryId' => $categoryId];
                    $media->setData($mediaData);
                    $media->save();
                }
            }
        } catch (Exception $e) {
        }
        $edit = \Mage::getBlock('Block\Admin\Category\Edit')->setTableRow($category)->toHtml();
        $this->makeResponse($edit);
    }
}
