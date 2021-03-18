<?php $attributes =  $this->getAttributes(); ?>

<div class="container">
    <div id="title">
        <b>Attributs</b>
        <hr style="border-color: black;">
    </div>
    <a onclick="mage.setUrl('<?php echo $this->getUrl('form', 'admin_attribute') ?>').resetPrams().load();" href="javascript:void(0)" type="button" class="btn btn-success">Create Attribute</a>
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Attribute Id</th>
                    <th scope="col">Entity Type Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Code</th>
                    <th scope="col">Input Type</th>
                    <th scope="col">Backend Type</th>
                    <th scope="col">Sort Order</th>
                    <th scope="col">Backend Model</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$attributes) : ?>
                    <tr>
                        <td colspan="4">No record Found</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($attributes->getData() as $attribute) : ?>
                        <tr>
                            <td><?php echo $attribute->attributeId ?></td>
                            <td><?php echo $attribute->entityTypeId ?></td>
                            <td><?php echo $attribute->name ?></td>
                            <td><?php echo $attribute->code ?></td>
                            <td><?php echo $attribute->inputType ?></td>
                            <td><?php echo $attribute->backendType ?></td>
                            <td><?php echo $attribute->sortOrder ?></td>
                            <td><?php echo $attribute->backendModel ?></td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('form', 'admin_attribute', ['id' => $attribute->attributeId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-pencil-alt'></i></a>
                                <a class="ml-3" onclick="mage.setUrl('<?php echo $this->getUrl('delete', 'admin_attribute', ['id' => $attribute->attributeId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>