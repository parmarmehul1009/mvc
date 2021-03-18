<?php $attribute = $this->getTableRow(); ?>
<?php $options = $this->getOPtions() ?>
<div class="container">
    <div id="title">
        <b>Options</b>
        <hr style="border-color: black;">
    </div>
    <div class="d-flex">
        <a onclick="addOption();" href="javascript:void(0)" type="button" class="btn btn-success">Create Option</a>
        <button onclick="mage.setForm(this).setUrl('<?php echo $this->getUrl('update', 'admin_attribute_option', null, true) ?>').load()" type="button" class="btn btn-primary ml-auto">Update Option</button>
    </div>
    <div>
        <table class="table" id="existingOption">
            <tbody>
                <?php if (!$options) : ?>
                    <tr>
                        <td colspan="4">No record Found</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($options->getData() as $option) : ?>
                        <tr>
                            <td><input type="text" name="data[exist][<?php echo $option->optionId ?>][name]" value="<?php echo $option->name ?>"></td>
                            <td><input type="text" name="data[exist][<?php echo $option->optionId ?>][sortOrder]" value="<?php echo $option->sortOrder ?>"></td>
                            <td><a class="btn btn-sm btn-danger" onclick="removeTr(this);" href="javascript:void(0)">Remove</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div>
        <table class="table d-none" id="newOption">
            <tbody>
                <tr>
                    <td><input type="text" name="data[new][name][]" value=""></td>
                    <td><input type="text" name="data[new][sortOrder][]" value=""></td>
                    <td><a class="btn btn-sm btn-danger" onclick="removeTr(this);" href="javascript:void(0)">Remove</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function removeTr(button) {
        $(button).parent().parent().remove();
    };

    function addOption() {
        var newOption = $('#newOption').children().children().clone();
        $('#existingOption').children().append(newOption);
    };
</script>