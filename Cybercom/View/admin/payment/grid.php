<?php
$payments = $this->getPayments();
?>
<div class="container">
    <div id="title">
        <b>Read Contacts</b>
        <hr style="border-color: black;">
    </div>
    <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, null) ?>').load();" href="javascript:void(0)" type="button" class="btn btn-success">Create Payment</a>
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">MethodId</th>
                    <th scope="col">Name</th>
                    <th scope="col">Code</th>
                    <th scope="col">description</th>
                    <th scope="col">createdDate</th>
                    <th scope="col">status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$payments) : ?>
                    <tr>
                        <td colspan="3">No Record Found.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($payments->getData()  as $payment) : ?>
                        <tr>
                            <td><?php echo $payment->methodId ?></td>
                            <td><?php echo $payment->name ?></td>
                            <td><?php echo $payment->code ?></td>
                            <td><?php echo $payment->description ?></td>
                            <td><?php echo $payment->createdDate ?></td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('status', null, ['id' => $payment->methodId, 'status' => !$payment->status]) ?>').load();" href="javascript:void(0)" <?php if ($payment->status) : echo 'class="btn btn-sm btn-primary"'; ?>; <?php else : echo 'class="btn btn-sm btn-warning"' ?><?php endif; ?>><?php if ($payment->status) : echo 'Enable'; ?><?php else : echo 'Disable'; ?><?php endif; ?></a>
                            </td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, ['id' => $payment->methodId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-pencil-alt'></i></a>
                                <a class="ml-3" onclick="mage.setUrl('<?php echo $this->getUrl('delete', null, ['id' => $payment->methodId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>