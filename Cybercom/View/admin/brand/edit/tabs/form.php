<?php $brand = $this->getTableRow(); ?>
<div class="row">
    <div class="form-group col-md-5">
        <label>name</label> <span id="name-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="brand[name]" id="name" class="form-control" placeholder="Enter name" value="<?php echo $brand->name ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>File</label> <span id="name-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="file" name="brand[image]" id="upload-image" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>status</label> <span id="description-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <select name="brand[status]" id="status" required>
                <?php
                foreach ($brand->getStatusOption() as $key => $value) {
                ?>
                    <option value="<?php echo $key ?>" <?php if ($key == "$brand->status") echo ' selected="selected"'; ?>><?php echo $value ?></option>
                <?php }
                ?>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <button type="button" onclick="mage.setFile(this,'#upload-image').setUrl('<?php echo $this->getUrl('save', 'admin_brand', null, true) ?>').uploadFile();" name="send" class="btn btn-success" value="Save">Upload</button>
    </div>
</div>