<?php
$admin = $this->getTableRow();
?>
<div class="container">
    <div id="title">
        <b>Add/Update Admin</b>
    </div>
    <hr style="border-color: black;">
    <div class="first-btn">
        <div class="container">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>UserName</label> <span id="firstName-info" class="invalid-feedback"></span>
                    <div class="input-group">
                        <input type="text" class="form-control" name="admin[userName]" id="firstName" placeholder="Enter FirstName" value="<?php echo $admin->userName ?>" required>
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label>Password</label> <span id="password-info" class=" invalid-feedback"></span>
                    <div class="input-group">
                        <input type="password" name="admin[password]" id="password" class="form-control" placeholder="Enter Password" value="<?php echo $admin->password ?>" required>
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label>status</label> <span id="description-info" class=" invalid-feedback"></span>
                    <div class="input-group">
                        <select name="admin[status]" id="status" required>
                            <?php
                            foreach ($admin->getStatusOptions() as $key => $value) {
                            ?>
                                <option value="<?php echo $key ?>" <?php if ($key == $admin->status) echo ' selected="selected"'; ?>><?php echo $value ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input onclick="mage.setForm(this).load();" type="button" name="send" class="btn btn-success" value="Update" />
                </div>
            </div>
        </div>

    </div>
</div>