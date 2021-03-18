<?php $groupPrices = $this->getGroupPrices(); ?>
<?php $product  = $this->getTableRow(); ?>
<button type="button" onclick="mage.setForm(this).setUrl('<?php echo $this->getUrl('save', 'admin_Product_GroupPrice', null, true) ?>').load();" class="ml-auto">Update</button>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Group Id</th>
            <th scope="col">Group Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Group Price</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!$groupPrices) : ?>
            <tr>
                <td colspan="3">No Data Found.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($groupPrices->getData() as $groupPrice) : ?>
                <tr>
                    <td><?php echo $groupPrice->groupId ?></td>
                    <td><?php echo $groupPrice->name ?></td>
                    <td><?php echo $product->price ?></td>
                    <td><input type="text" name="groupPrice[groupPrice][<?php echo $groupPrice->groupId ?>]" value="<?php echo $groupPrice->groupPrice ?>"></td>
                    <td><input type="hidden" name="groupPrice[<?php if ($groupPrice->entityId) : echo 'exist' ?><?php else : echo 'new' ?><?php endif; ?>][<?php echo $groupPrice->groupId ?>]" value="<?php echo $groupPrice->entityId ?>"></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>