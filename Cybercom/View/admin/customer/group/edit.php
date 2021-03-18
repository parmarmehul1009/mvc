<?php
$customer_group = $this->getTableRow();
?>
<div class="container">
    <div id="title">
        <b>Customer Group</b>
    </div>
    <hr style="border-color: black;">
    <div class="first-btn">
        <div class="container">
            <form method="POST" action="<?php echo $this->getUrl('save', null, ['id' => $customer_group->groupId])  ?>">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label>Name</label> <span id="firstName-info" class="invalid-feedback"></span>
                        <div class="input-group">
                            <input type="text" class="form-control" name="customer_group[name]" id="firstName" placeholder="Enter FirstName" value="<?php echo $customer_group->name ?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-5">
                        <label>status</label> <span id="description-info" class=" invalid-feedback"></span>
                        <div class="input-group">
                            <select name="customer_group[status]" id="status" required>
                                <?php
                                foreach ($customer_group->getStatusOptions() as $key => $value) {
                                ?>
                                    <option value="<?php echo $key ?>" <?php if ($key == $customer_group->status) echo ' selected="selected"'; ?>><?php echo $value ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input onclick="mage.setForm(this).load();" type="button" name="send" class="btn btn-success" value="Save" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>