<?php
$payment = $this->getTableRow();
?>
<div class="container">
    <div id="title">
        <b><?php if (!$payment->methodId) {
                echo 'Create ';
            } else {
                echo 'Update ';
            } ?>Payment</b>
    </div>
    <hr style="border-color: black;">
    <div class="first-btn">
        <div class="container">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>name</label> <span id="name-info" class="invalid-feedback"></span>
                    <div class="input-group">
                        <input type="text" name="payment[name]" id="name" class="form-control" placeholder="Enter name" value="<?php echo $payment->name ?>">
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label>Code</label> <span id="price-info" class="invalid-feedback"></span>
                    <div class="input-group">
                        <input type="number" name="payment[code]" id="price" class="form-control" placeholder="Enter price" value="<?php echo $payment->code ?>">
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label>description</label> <span id="description-info" class=" invalid-feedback"></span>
                    <div class="input-group">
                        <textarea name="payment[description]" id="description" cols="60" rows="2" placeholder="Enter description"><?php echo $payment->description ?></textarea>
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label>status</label> <span id="status-info" class=" invalid-feedback"></span>
                    <div class="input-group">
                        <select name="payment[status]" id="status">
                            <?php
                            foreach ($payment->getStatusOption() as $key => $value) {
                            ?>
                                <option value="<?php echo $key ?>" <?php if ($key == $payment->status) echo ' selected="selected"'; ?>><?php echo $value ?></option>
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