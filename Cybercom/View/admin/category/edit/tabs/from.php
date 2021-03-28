<?php $category = $this->getCategory(); ?>
<?php $categoriesOptions  = $this->getCategoriesOptions() ?>
<div class="row">
    <div class="form-group col-md-5">
        <label>Parent Category</label> <span id="name-info" class="invalid-feedback"></span>
        <div class="input-group">
            <select name="category[parentId]" id="parentId">
                <?php foreach ($categoriesOptions as $categoryId => $pathId) : ?>
                    <option value="<?php echo $categoryId ?>" <?php if ($categoryId == $category->parentId) : echo 'selected' ?><?php endif; ?>><?php echo $pathId ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>name</label> <span id="name-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="category[name]" id="name" class="form-control" placeholder="Enter name" value="<?php echo $category->name ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>description</label> <span id="description-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <textarea name="category[description]" id="description" cols="60" rows="2" placeholder="Enter description" value="" required><?php echo $category->description ?></textarea>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>Featured </label> <span id="name-info" class="invalid-feedback"></span>
        <div class="input-group">
            <select name="category[featured]" id="parentId">
                <option value="1" <?php if (1 == $category->featured) : echo 'selected' ?><?php endif; ?>>Yes</option>
                <option value="0" <?php if (0 == $category->featured) : echo 'selected' ?><?php endif; ?>>No</option>
            </select>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>status</label> <span id="description-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <select name="category[status]" id="status" required>
                <?php
                foreach ($category->getStatusOption() as $key => $value) {
                ?>
                    <option value="<?php echo $key ?>" <?php if ($key == "$category->status") echo ' selected="selected"'; ?>><?php echo $value ?></option>
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