<?php $product = $this->getTableRow(); ?>
<?php $categoriesOptions  = $this->getCategoriesOptions(); ?>
<?php $categorys = $this->getCategorys(); ?>

<div class="row">
    <div class="form-group col-md-5">
        <label>Category</label> <span id="description-info" class=" invalid-feedback"></span>
        <div class="">
            <select name="category[]" multiple required>
                <?php if ($categorys) : ?>
                    <?php foreach ($categoriesOptions as $key => $value) : ?>
                        <option value="<?php echo $key ?>" <?php foreach ($categorys->getData() as $category) : ?> <?php if ($key == $category->categoryId) echo ' selected="selected"'; ?> <?php endforeach; ?>><?php echo $value ?></option>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php foreach ($categoriesOptions as $key => $value) : ?>
                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>Serial Key</label> <span id="sku-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="text" class="form-control" name="product[sku]" id="sku" placeholder="Serial Key" value="<?php echo $product->sku ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>name</label> <span id="name-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="text" name="product[name]" id="name" class="form-control" placeholder="Enter name" value="<?php echo $product->name ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>price</label> <span id="price-info" class="invalid-feedback"></span>
        <div class="input-group">
            <input type="number" name="product[price]" id="price" class="form-control" placeholder="Enter price" value="<?php echo $product->price ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>discount</label> <span id="discount-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <input type="number" name="product[discount]" id="discount" class="form-control" placeholder="Enter discount" value="<?php echo $product->discount ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>quantity</label> <span id="quantity-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <input type="number" name="product[quantity]" id="quantity" class="form-control" placeholder="Enter quantity" value="<?php echo $product->quantity ?>" required>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>description</label> <span id="description-info" class=" invalid-feedback"></span>
        <div class="input-group">
            <textarea name="product[description]" id="description" cols="60" rows="2" placeholder="Enter description" value="" required><?php echo $product->description ?></textarea>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>status</label> <span id="description-info" class=" invalid-feedback"></span>
        <div class="">
            <select name="product[status]" required>
                <?php foreach ($product->getStatusOptions() as $key => $value) : ?>
                    <option value="<?php echo $key ?>" <?php if ($key == $product->status) echo ' selected="selected"'; ?>><?php echo $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <input onclick="mage.setForm(this).load()" type="button" name="send" class="btn btn-success" value="Save" />
    </div>
</div>