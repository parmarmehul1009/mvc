<?php $attribute = $this->getTableRow(); ?>

<div class="row">
    <div class="form-group col-md-5">
        <label>Entity Type Id</label> <span id="entityTypeId-info" class="invalid-feedback"></span>
        <div class="input-group">
            <select name="attribute[entityTypeId]" id="entityTypeId">
                <?php foreach ($attribute->getEntityTypeOptions() as $key => $entityType) : ?>
                    <option value="<?php echo $key; ?>"><?php echo $entityType; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>Name</label> <span id="name-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="attribute[name]" id="name" class="form-control" placeholder="Enter Name" value="<?php echo $attribute->name ?>">
        </div>
    </div>
    <div class=" form-group col-md-5">
        <label>Input Type</label> <span id="inputtype-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <select name="attribute[inputType]" id="inputType">
                <?php foreach ($attribute->getInputTypeOptions() as $key => $inputType) : ?>
                    <option value="<?php echo $key; ?>"><?php echo $inputType; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class=" form-group col-md-5">
        <label>Code</label> <span id="code-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="attribute[code]" id="code" class="form-control" placeholder="Enter Code" value="<?php echo $attribute->code ?>">
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>Backend Type</label> <span id="backendType-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <select name="attribute[backendType]" id="backendType">
                <?php foreach ($attribute->getBackendTypeOptions() as $key => $backendType) : ?>
                    <option value="<?php echo $key; ?>"><?php echo $backendType; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>Sort Order</label> <span id="sortOrder-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="attribute[sortOrder]" id="sortOrder" class="form-control" placeholder="Enter Title" value="<?php echo $attribute->sortOrder ?>">
        </div>
    </div>
    <div class=" form-group col-md-5">
        <label>Backend Model</label> <span id="backendModel-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="attribute[backendModel]" id="backendModel" class="form-control" placeholder="Enter Title" value="<?php echo $attribute->backendModel ?>">
        </div>
    </div>
</div>
<div class=" row">
    <div class="col">
        <input onclick="mage.setForm(this).load();" type="button" name="send" class="btn btn-success" value="Save" />
    </div>
</div>