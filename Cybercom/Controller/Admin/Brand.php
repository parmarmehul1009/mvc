<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Brand extends \Controller\Core\Admin
{

    public function __construct()
    {
        parent::__construct();
        $this->setMessage(\Mage::getModel('Model\Admin\Message'));
    }

    public function indexAction()
    {
        $layout = $this->getlayout();
        $this->renderLayout();
    }
    public function gridAction()
    {
        $grid = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function formAction()
    {
        $brand = \Mage::getModel('Model\Brand');
        if ($id = $this->getRequest()->getGet('id')) {
            $brand = $brand->load($id);
            if (!$brand) {
                throw new \Exception("Record Not Found.");
            }
        }
        $edit = \Mage::getBlock('Block\Admin\Brand\Edit')->setTableRow($brand)->toHtml();
        $this->makeResponse($edit);
    }

    public function saveAction()
    {
        $brandData = $this->getRequest()->getPost('brand');
        try {
            $brand = \Mage::getBlock('Model\Brand');
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalide Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $brand  = $brand->load($id);
                if (!$brand) {
                    throw new \Exception("Record not found.");
                }
            }
            if (array_key_exists('file', $_FILES)) {
                if ($id) {
                    $path = \Mage::getbaseDir('media\brand\\') . $brand->image;
                    unlink($path);
                }
                $file = $_FILES['file']['name'];
                if ($file) {
                    $temp_name = $_FILES['file']['tmp_name'];
                    $filePath = \Mage::getbaseDir('media\brand\\');
                    $fileName = time() . $file;
                    move_uploaded_file($temp_name, $filePath . $fileName);
                    $brand->image = $fileName;
                }
            }
            $brand->name = $brandData['name'];
            $brand->status = $brandData['status'];
            $brand->save();
        } catch (\Exception $e) {
        }
        $grid = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    function deleteAction()
    {
        try {
            $brandId = (int) $this->getRequest()->getGet('id');
            if (!$brandId) {
                throw new \Exception("No id Found.");
            }
            $brand = \Mage::getModel('Model\Brand');
            $brand->load($brandId);
            $path = \Mage::getbaseDir('media\brand\\') . $brand->image;
            unlink($path);
            if (!$brand->delete()) {
                throw new \Exception("No record For Given Id");
            }
            $this->getMessage()->setSuccess('Record Deleted.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function filterAction()
    {
        $data = $this->getRequest()->getPost('filter');
        $this->getFilter()->setFilters($data);
        $grid = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
