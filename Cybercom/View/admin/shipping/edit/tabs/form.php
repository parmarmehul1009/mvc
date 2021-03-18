<?php
$shipping = $this->getTableRow();
?>
<div class="container">
    <div id="title">
        <b>Update Shipping</b>
    </div>
    <hr style="border-color: black;">
    <div class="first-btn">
        <div class="container">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>name</label> <span id="name-info" class="invalid-feedback"></span>
                    <div class="input-group">
                        <input type="text" name="shipping[name]" id="name" class="form-control" placeholder="Enter name" value="<?php echo $shipping->name ?>">
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label>Code</label> <span id="price-info" class="invalid-feedback"></span>
                    <div class="input-group">
                        <input type="number" name="shipping[code]" id="price" class="form-control" placeholder="Enter price" value="<?php echo $shipping->code ?>">
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label>Amount</label> <span id="discount-info" class=" invalid-feedback"></span>
                    <div class="input-group">
                        <input type="number" name="shipping[amount]" id="discount" class="form-control" placeholder="Enter discount" value="<?php echo $shipping->amount ?>">
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label>description</label> <span id="description-info" class=" invalid-feedback"></span>
                    <div class="input-group">
                        <textarea name="shipping[description]" id="description" cols="60" rows="2" placeholder="Enter description"><?php echo $shipping->description ?></textarea>
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label>status</label> <span id="status-info" class=" invalid-feedback"></span>
                    <div class="input-group">
                        <select name="shipping[status]" id="status">
                            <?php
                            foreach ($shipping->getStatusOptions() as $key => $value) {
                            ?>
                                <option value="<?php echo $key ?>" <?php if ($key == $shipping->status) echo ' selected="selected"'; ?>><?php echo $value ?></option>
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
        </div>
    </div>
</div>