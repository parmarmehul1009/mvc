<?php
$customerGroups = $this->getCustomerGroups();
?>
<div class="container">
    <div id="title">
        <b>Read Contacts</b>
        <hr style="border-color: black;">
    </div>
    <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, null) ?>').load();" href="javascript:void(0)" type="button" class="btn btn-success">Create Customer Group</a>
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">GroupId</th>
                    <th scope="col">Name</th>
                    <th scope="col">CreatedDate</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$customerGroups) : ?>
                    <tr>
                        <td colspan="3">No Record Found.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($customerGroups->getData() as $customerGroup) : ?>
                        <tr>
                            <td><?php echo $customerGroup->groupId ?></td>
                            <td><?php echo $customerGroup->name ?></td>
                            <td><?php echo $customerGroup->createdDate ?></td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('status', null, ['id' => $customerGroup->groupId, 'status' => !$customerGroup->status]) ?>').load();" href="javascript:void(0)" <?php if ($customerGroup->status) : echo 'class="btn btn-sm btn-primary"'; ?>; <?php else : echo 'class="btn btn-sm btn-warning"' ?><?php endif; ?>><?php if ($customerGroup->status) : echo 'Enable'; ?><?php else : echo 'Disable'; ?><?php endif; ?></a>
                            </td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, ['id' => $customerGroup->groupId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-pencil-alt'></i></a>
                                <a class="ml-3" onclick="mage.setUrl('<?php echo $this->getUrl('delete', null, ['id' => $customerGroup->groupId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>