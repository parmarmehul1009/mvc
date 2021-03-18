<?php
$shipping = $this->getShippingAddress();
$billing = $this->getBillingAddress();
?>
<label><b>Billing Address</b></label>
<div class="row">
    <div class="form-group col-md-5">
        <label>Address</label> <span id="address-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="text" class="form-control" name="billing[address]" id="address" placeholder="Enter Address" value="<?php echo $billing->address ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>City</label> <span id="lastName-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="billing[city]" id="city" class="form-control" placeholder="Enter City" value="<?php echo $billing->city ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>State</label> <span id="state-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="state" name="billing[state]" id="state" class="form-control" placeholder="Enter State" value="<?php echo $billing->state ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>ZipCode</label> <span id="zipcode-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="billing[zipcode]" id="zipcode" class="form-control" placeholder="Enter Zipcode" value="<?php echo $billing->zipCode ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>Country</label> <span id="country-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="billing[country]" id="country" class="form-control" placeholder="Enter Country" value="<?php echo $billing->country ?>" required>
        </div>
    </div>
</div>
<label><b>Shipping Address</b></label>
<div class="row">
    <div class="form-group col-md-5">
        <label>Address</label> <span id="address-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="text" class="form-control" name="shipping[address]" id="address" placeholder="Enter Address" value="<?php echo $shipping->address ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>City</label> <span id="city-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="shipping[city]" id="city" class="form-control" placeholder="Enter City" value="<?php echo $shipping->city ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>State</label> <span id="state-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="state" name="shipping[state]" id="state" class="form-control" placeholder="Enter State" value="<?php echo $shipping->state ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>ZipCode</label> <span id="zipcode-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="shipping[zipcode]" id="zipcode" class="form-control" placeholder="Enter Zipcode" value="<?php echo $shipping->zipCode ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>Country</label> <span id="country-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="shipping[country]" id="country" class="form-control" placeholder="Enter Country" value="<?php echo $shipping->country ?>" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <input onclick="mage.setForm(this).setUrl('<?php echo $this->getUrl('save', 'admin_customer_address', ['id' => $this->getRequest()->getGet('id')], null, true) ?>').load();" type="button" name="send" class="btn btn-success" value="Save" />
    </div>
</div>