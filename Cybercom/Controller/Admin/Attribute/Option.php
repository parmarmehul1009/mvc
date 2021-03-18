<?php

namespace Controller\Admin\Attribute;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Option extends \Controller\Core\Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function updateAction()
    {
        $attributeId = $this->getRequest()->getGet('id');
        $data = $this->getRequest()->getPost('data');
        if (array_key_exists('exist', $data)) {
            $exists =  $data['exist'];
            $ids = '';
            foreach ($exists as $optionId => $value) {
                $optionObj = \Mage::getModel('Model\Attribute\Option');
                $option = $optionObj->load($optionId);
                $option->setData($value);
                $option->save();
                $ids .= $optionId . ',';
            }
            $ids = '(' . rtrim($ids, ',') . ')';
            $optionObj = \Mage::getModel('Model\Attribute\Option');
            $query = "DELETE FROM `attribute_option` WHERE `attributeId` = '{$attributeId}' AND `optionId` NOT IN {$ids}";
            $optionObj->getAdapter()->update($query);
        }
        if (array_key_exists('new', $data)) {
            $news = $data['new'];
            $result = array_combine($news['name'], $news['sortOrder']);
            foreach ($result as $name => $sortOrder) {
                if ($name != '' && $sortOrder != '') {
                    $optionObj = \Mage::getModel('Model\Attribute\Option');
                    $optionObj->name = $name;
                    $optionObj->sortOrder = $sortOrder;
                    $optionObj->attributeId = $attributeId;
                    $optionObj->save();
                }
            }
        }
        $grid  = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
