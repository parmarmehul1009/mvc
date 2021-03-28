<?php

namespace Controller\Admin;



\Mage::loadFileByClassName('Controller\Core\Admin');
class Payment extends \Controller\Core\Admin
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
    public function gridAction()
    {
        $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function formAction()
    {
        $payment = \Mage::getModel('Model\Payment');
        if ($id = $this->getRequest()->getGet('id')) {
            $payment = $payment->load($id);
            if (!$payment) {
                throw new \Exception("No Record For given Id.");
            }
        }
        $edit = \Mage::getBlock('Block\Admin\Payment\Edit')->setTableRow($payment)->toHtml();
        $this->makeResponse($edit);
    }

    public function saveAction()
    {
        try {
            $payment = \Mage::getModel('Model\Payment');
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalide Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $payment = $payment->load($id);
                if (!$payment) {
                    throw new \Exception("Record Not Found.");
                }
            } else {
                $payment->createdDate = date("Y-m-d H:i:s");
            }
            $paymentData = $this->getRequest()->getPost('payment');
            $payment->setData($paymentData);
            $recordId = $payment->save();
            if (!$recordId) {
                throw new \Exception("Record Not Inserted.");
            };
            $this->getMessage()->setSuccess('Record Saved.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
        $this->makeResponse($grid);
    }
    public function statusAction()
    {
        try {
            $methodId = (int) $this->getRequest()->getGet('id');
            $status = $this->getRequest()->getGet('status');
            if (!$methodId) {
                throw new \Exception("No record Found.");
            }
            $payment = \Mage::getModel('Model\Payment');
            $payment->load($methodId);
            $payment->status = $status;
            $recordId = $payment->save();
            if (!$recordId) {
                throw new \Exception("Unable to update satatus.");
            };
            $this->getMessage()->setSuccess('Status Updated.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $methodId = (int) $this->getRequest()->getGet('id');
            if (!$methodId) {
                throw new \Exception("Id Not Found.");
            }
            $payment = \Mage::getModel('Model\Payment');
            $payment->load($methodId);
            if (!$payment->delete()) {
                throw new \Exception("No record For Given Id");
            }
            $this->getMessage()->setSuccess('Record Deleted.');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function filterAction()
    {
        $data = $this->getRequest()->getPost('filter');
        $this->getFilter()->setFilters($data);
        $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
