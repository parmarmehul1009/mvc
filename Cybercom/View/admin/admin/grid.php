<?php
$admins = $this->getAdmins();
?>
<div class="container">
    <div id="title">
        <b>Read Contacts</b>
        <hr style="border-color: black;">
    </div>
    <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, null) ?>').resetPrams().load();" href="javascript:void(0)" type="button" class="btn btn-success">Create admin</a>
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">adminId</th>
                    <th scope="col">UserName</th>
                    <th scope="col">password</th>
                    <th scope="col">status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$admins) : ?>
                    <tr>
                        <td>No Record Found.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($admins->getData() as $admin) : ?>
                        <tr>
                            <td><?php echo $admin->adminId ?></td>
                            <td><?php echo $admin->userName ?></td>
                            <td><?php echo $admin->password ?></td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('status', null, ['id' => $admin->adminId, 'status' => !$admin->status]) ?>').load();" href="javascript:void(0)" <?php if ($admin->status) : echo 'class="btn btn-sm btn-primary"'; ?>; <?php else : echo 'class="btn btn-sm btn-warning"' ?><?php endif; ?>><?php if ($admin->status) : echo 'Enable'; ?><?php else : echo 'Disable'; ?><?php endif; ?></a>
                            </td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, ['id' => $admin->adminId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-pencil-alt'></i></a>
                                <a class="ml-3" onclick="mage.setUrl('<?php echo $this->getUrl('delete', null, ['id' => $admin->adminId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>