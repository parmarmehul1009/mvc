<?php
$categories = $this->getCategories();
?>
<div class="container">
    <div id="title">
        <b>Read Contacts</b>
        <hr style="border-color: black;">
    </div>
    <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, null) ?>').resetPrams().load();" href="javascript:void(0)" type="button" class="btn btn-success">Create Category</a>
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">categoryId</th>
                    <th scope="col">Name</th>
                    <th scope="col">description</th>
                    <th scope="col">status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$categories) : ?>
                    <tr>
                        <td>No record Found</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($categories->getData() as $category) : ?>
                        <tr>
                            <td><?php echo $category->categoryId ?></td>
                            <td><?php echo $this->getName($category) ?></td>
                            <td><?php echo $category->description ?></td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('status', null, ['id' => $category->categoryId, 'status' => !$category->status]) ?>').load();" href="javascript:void(0)" <?php if ($category->status) : echo 'class="btn btn-sm btn-primary"'; ?>; <?php else : echo 'class="btn btn-sm btn-warning"' ?><?php endif; ?>><?php if ($category->status) : echo 'Enable'; ?><?php else : echo 'Disable'; ?><?php endif; ?></a>
                            </td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, ['id' => $category->categoryId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-pencil-alt'></i></a>
                                <a class="ml-3" onclick="mage.setUrl('<?php echo $this->getUrl('delete', null, ['id' => $category->categoryId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>