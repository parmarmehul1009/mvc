<?php

namespace Block\Admin\Product;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareColumns()
    {
        $this->addColumn('productId', [
            'field' => 'productId',
            'label' => 'Product Id',
            'type' => 'number',
        ]);

        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'Product Name',
            'type' => 'text',
        ]);

        $this->addColumn('price', [
            'field' => 'price',
            'label' => 'Product Price',
            'type' => 'text',
        ]);

        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'Product status',
            'type' => 'enum',
        ]);
    }

    public function prepareActions()
    {

        $this->addAction('edit', [
            'label' => 'Edit',
            'method' => 'getEditUrl',
            'class' => 'btn btn-sm btn-primary ml-1',
            'ajax' => true,
        ]);

        $this->addAction('delete', [
            'label' => 'Delete',
            'method' => 'getDeleteUrl',
            'class' => 'btn btn-sm btn-primary ml-1',
            'ajax' => true,
        ]);

        $this->addAction('adToCart', [
            'label' => 'Add To Cart',
            'method' => 'getAddToCartUrl',
            'class' => 'btn btn-sm btn-success ml-1',
            'ajax' => true,
        ]);
    }

    public function getEditUrl($row)
    {
        $url = $this->getUrl('form', 'admin_product', ['id' => $row->productId], true);
        echo "mage.setUrl('{$url}').load()";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl('delete', 'admin_product', ['id' => $row->productId], true);
        echo "mage.setUrl('{$url}').load()";
    }

    public function getAddToCartUrl($row)
    {
        $url = $this->getUrl('addToCart', 'admin_cart', ['id' => $row->productId], true);
        echo "mage.setUrl('{$url}').load()";
    }

    public function prepareButtons()
    {
        $this->addButton('addnew', [
            'label' => 'Add New',
            'method' => 'getAddNewUrl',
            'class' => 'btn btn-sm btn-primary ml-1',
        ]);

        $this->addButton('applyfilter', [
            'label' => 'Apply Filter',
            'method' => 'getApplyFilterUrl',
            'class' => 'btn btn-sm btn-success ml-1',
        ]);
    }


    public function getAddNewUrl()
    {
        $url = $this->getUrl('form', 'admin_product');
        echo "mage.setUrl('{$url}').load()";
    }

    public function prepareCollection()
    {
        $filters = $this->getFilter()->getFilters();
        $this->getFilter()->clearFilters();
        $product = \Mage::getModel('Model\Product');
        $query = "SELECT * FROM `{$product->getTableName()}`";
        if ($filters) {
            $str = '';
            foreach ($filters as $fild => $value) {
                if ($value) {
                    $str .= "`{$fild}` LIKE '%{$value}%' ";
                }
            }
            $query = "SELECT * FROM `{$product->getTableName()}` WHERE {$str}";
            if ($str == '') {
                $query = "SELECT * FROM `{$product->getTableName()}`";
            }
        }
        $collection = $product->fetchAll($query);
        $this->setCollection($collection);
        $this->getFilter()->clearFilters();
        return $this;
    }

    public function getTitle()
    {
        return 'Manage Product';
    }
}
