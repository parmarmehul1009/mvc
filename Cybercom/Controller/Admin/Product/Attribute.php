<?php

namespace Controller\Admin\Product;

use function PHPSTORM_META\type;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Attribute extends \Controller\Core\Admin
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

    public function saveAction()
    {
        $product = \Mage::getBlock('Model\Product');
        $data = $this->getRequest()->getPost('data');
        if ($data) {
            foreach ($data as $productId => $attribute) {
                $product = $product->load($productId);
                foreach ($attribute as $key => $value) {
                    if (gettype($value) != 'array') {
                        $product->$key = $value;
                    } else {
                        $string = '';
                        foreach ($value as $key1 => $value) {
                            $string .= ',' . $key1;
                        }
                        $value1 = ltrim($string, ',');
                        $product->$key = $value1;
                    }
                }
                $product->save();
            }
        }
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
