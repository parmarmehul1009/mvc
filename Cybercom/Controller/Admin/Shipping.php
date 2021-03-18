<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Shipping extends \Controller\Core\Admin
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
    function gridAction()
    {
        $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    function formAction()
    {
        $shipping = \Mage::getModel('Model\Shipping');
        if ($id = $this->getRequest()->getGet('id')) {
            $shipping = $shipping->load($id);
            if (!$shipping) {
                throw new \Exception("No Record For given Id.");
            }
        }
        $edit = \Mage::getBlock('Block\Admin\Shipping\Edit')->setTableRow($shipping)->toHtml();
        $this->makeResponse($edit);
    }

    function saveAction()
    {
        try {
            $shipping = \Mage::getModel('Model\Shipping');
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalide Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $shipping = $shipping->load($id);
                if (!$shipping) {
                    throw new \Exception("No Record Found.");
                }
            } else {
                $shipping->createdDate = date('Y-m-d H:i:s');
            }
            $shippingData = $this->getRequest()->getPost('shipping');
            $shipping->setData($shippingData);
            $recordId = $shipping->save();
            if (!$recordId) {
                throw new \Exception("Record Not Inserted.");
            };
            $this->getMessage()->setSuccess('Record Inserted successfully.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    function statusAction()
    {
        try {
            $shipping  = \Mage::getModel('Model\Shipping');
            $methodId = (int) $this->getRequest()->getGet('id');
            $status = (int) $this->getRequest()->getGet('status');
            if (!$methodId) {
                throw new \Exception("No Id Found.");
            }
            $shipping->load($methodId);
            $shipping->status = $status;
            $recordId = $shipping->save();
            if (!$recordId) {
                throw new \Exception("Now Results for given ID.");
            }
            $this->getMessage()->setSuccess('Status Updated');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    function deleteAction()
    {
        try {
            $methodId = (int) $this->getRequest()->getGet('id');
            if (!$methodId) {
                throw new \Exception("Id not Found");
            }
            $shipping = \Mage::getModel('Model\Shipping');
            $shipping->load($methodId);
            if (!$shipping->delete()) {
                throw new \Exception("No record For Given Id.");
            }
            $this->getMessage()->setSuccess('Record Deletd successfully.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
