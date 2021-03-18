<?php
$customers = $this->getCustomers();
?>

<div class="container">
    <div id="title">
        <b>Read Contacts</b>
        <hr style="border-color: black;">
    </div>
    <a onclick="mage.setUrl('<?php echo $this->getUrl('form', 'admin_customer', null, false) ?>').load();" href="javascript:void(0)" type="button" class="btn btn-success">Create Customer</a>
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">firstName</th>
                    <th scope="col">lastName</th>
                    <th scope="col">email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Customer Group Name</th>
                    <th scope="col">Zipcode</th>
                    <th scope="col">status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$customers) : ?>
                    <tr>
                        <td colspan="4">No Date Found.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($customers->getData() as $customer) : ?>
                        <tr>
                            <td><?php echo $customer->customerId ?></td>
                            <td><?php echo $customer->firstName ?></td>
                            <td><?php echo $customer->lastName ?></td>
                            <td><?php echo $customer->email ?></td>
                            <td><?php echo $customer->password ?></td>
                            <td><?php echo $customer->groupName ?></td>
                            <td><?php echo $customer->zipCode ?></td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('status', 'admin_customer', ['id' => $customer->customerId, 'status' => !$customer->status]) ?>').load();" href="javascript:void(0)" <?php if ($customer->status) : echo 'class="btn btn-sm btn-primary"'; ?>; <?php else : echo 'class="btn btn-sm btn-warning"' ?><?php endif; ?>><?php if ($customer->status) : echo 'Enable'; ?><?php else : echo 'Disable'; ?><?php endif; ?></a>
                            </td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('form', 'admin_customer', ['id' => $customer->customerId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-pencil-alt'></i></a>
                                <a class="ml-3" onclick="mage.setUrl('<?php echo $this->getUrl('delete', 'admin_customer', ['id' => $customer->customerId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>