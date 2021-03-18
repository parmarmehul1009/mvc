<?php
$products = $this->getProducts();

?>

<div class="container">
    <div id="title">
        <b>Read Contacts</b>
        <hr style="border-color: black;">
    </div>
    <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, null) ?>').load();" href="javascript:void(0)" type="button" class="btn btn-success">Create Product</a>

    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">productId</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">quantity</th>
                    <th scope="col">createdDate</th>
                    <th scope="col">updatedDate</th>
                    <th scope="col">status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$products) : ?>
                    <tr>
                        <td colspan="3">No Date Found.</td>
                    </tr>
                <?php else :  ?>
                    <?php foreach ($products->getData() as $product) : ?>

                        <tr class='disabled'>
                            <td><?php echo $product->productId ?></td>
                            <td><?php echo $product->name ?></td>
                            <td><?php echo $product->price ?></td>
                            <td><?php echo $product->quantity ?></td>
                            <td><?php echo $product->createdDate ?></td>
                            <td><?php echo $product->updatedDate ?></td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('status', 'admin_product', ['id' => $product->productId, 'status' => !$product->status]) ?>').load();" href="javascript:void(0)" <?php if ($product->status) : echo 'class="btn btn-sm btn-primary"'; ?>; <?php else : echo 'class="btn btn-sm btn-warning"' ?><?php endif; ?>><?php if ($product->status) : echo 'Enable'; ?><?php else : echo 'Disable'; ?><?php endif; ?></a>
                            </td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('form', 'admin_product', ['id' => $product->productId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-pencil-alt'></i></a>
                                <a class="ml-3" onclick="mage.setUrl('<?php echo $this->getUrl('delete', 'admin_product', ['id' => $product->productId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-trash-alt'></i></a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>