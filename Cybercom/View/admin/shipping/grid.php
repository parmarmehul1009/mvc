<?php
$shippings = $this->getShippings();
?>

<div class="container">
    <div id="title">
        <b>Read Contacts</b>
        <hr style="border-color: black;">
    </div>
    <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, null, false) ?>').load();" href="javascript:void(0)" type="button" class="btn btn-success">Create Shipping</a>

    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">MethodId</th>
                    <th scope="col">Name</th>
                    <th scope="col">Code</th>
                    <th scope="col">Amount</th>
                    <th scope="col">description</th>
                    <th scope="col">createdDate</th>
                    <th scope="col">status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$shippings) : ?>
                    <tr>
                        <td colspan="3">No Record Found.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($shippings->getData() as $shipping) : ?>
                        <tr>
                            <td><?php echo $shipping->methodId ?></td>
                            <td><?php echo $shipping->name ?></td>
                            <td><?php echo $shipping->code ?></td>
                            <td><?php echo $shipping->amount ?></td>
                            <td><?php echo $shipping->description ?></td>
                            <td><?php echo $shipping->createdDate ?></td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('status', null, ['id' => $shipping->methodId, 'status' => !$shipping->status]) ?>').load();" href="javascript:void(0)" <?php if ($shipping->status) : echo 'class="btn btn-sm btn-primary"'; ?>; <?php else : echo 'class="btn btn-sm btn-warning"' ?><?php endif; ?>><?php if ($shipping->status) : echo 'Enable'; ?><?php else : echo 'Disable'; ?><?php endif; ?></a>
                            </td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, ['id' => $shipping->methodId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-pencil-alt'></i></a>
                                <a class="ml-3" onclick="mage.setUrl('<?php echo $this->getUrl('delete', null, ['id' => $shipping->methodId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>