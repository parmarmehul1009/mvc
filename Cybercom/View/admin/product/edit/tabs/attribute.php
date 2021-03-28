<?php $attributes = $this->getAttributes() ?>
<?php $product  = $this->getTableRow(); ?>

<button onclick="mage.setForm(this).setUrl('<?php echo $this->getUrl('save', 'admin_product_attribute', null, true) ?>').load()" type="button" class="btn btn-primary ml-auto">Update Option</button>
<div>
    <table>
        <tbody>
            <?php if ($attributes) : ?>
                <tr>
                    <?php foreach ($attributes->getData() as $attribute) : ?>
                        <?php
                        $block = \Mage::getBlock('Block\Admin\Attribute\Display');
                        $block->setAttribute($attribute);
                        $block->setProduct($product);
                        echo $block->toHtml()
                        ?>
                    <?php endforeach; ?>
                </tr>
            <?php else : ?>
                <tr>
                    <td>No Attributes For Product</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>