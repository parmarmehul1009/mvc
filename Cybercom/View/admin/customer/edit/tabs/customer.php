<?php
$customer = $this->getCustomer();

$customerGroups = $this->getCustomerGroups();

?>
<div class="row">
    <div class="form-group col-md-5">
        <label>Customer Group</label> <span id="description-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <select name="customer[groupId]" id="status" required>
                <?php if (!$customerGroups) : ?>
                <?php else : ?>
                    <?php foreach ($customerGroups->getData() as $customerGroup) : ?>
                        <option value="<?php echo $customerGroup->groupId ?>" <?php if ($customerGroup->groupId == $customer->groupId) echo ' selected="selected"'; ?>><?php echo $customerGroup->name ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>firstName</label> <span id="firstName-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="text" class="form-control" name="customer[firstName]" id="firstName" placeholder="Enter FirstName" value="<?php echo $customer->firstName ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>lastName</label> <span id="lastName-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="customer[lastName]" id="lastName" class="form-control" placeholder="Enter LastName" value="<?php echo $customer->lastName ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>email</label> <span id="email-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="email" name="customer[email]" id="email" class="form-control" placeholder="Enter Email" value="<?php echo $customer->email ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>mobile</label> <span id="mobile-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="customer[mobile]" id="mobile" class="form-control" placeholder="Enter Mobile Number" value="<?php echo $customer->mobile ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>Password</label> <span id="password-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <input type="password" name="customer[password]" id="password" class="form-control" placeholder="Enter Password" value="<?php echo $customer->password ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>status</label> <span id="description-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <select name="customer[status]" id="status" required>
                <?php
                foreach ($customer->getStatusOption() as $key => $value) {
                ?>
                    <option value="<?php echo $key ?>" <?php if ($key == $customer->status) echo ' selected="selected"'; ?>><?php echo $value ?></option>
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