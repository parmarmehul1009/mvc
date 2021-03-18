<?php $attribute = $this->getAttribute(); ?>
<?php $options = $this->getOPtions(); ?>
<?php $product  = $this->getProduct(); ?>

<table class="table" id="existingOption">
    <tbody>
        <?php switch ($attribute->inputType):
            case 'select': ?>
                <tr>
                    <div class="form-group row container">
                        <label class="col-md-12" for=""><?php echo  $attribute->name;
                                                        $attribute1 = $attribute->code ?></label>
                        <select class="custom-select col-md-12" name="data[<?php echo $product->productId ?>][<?php echo $attribute->code ?>]" id="">
                            <?php if (!$options) : ?>

                            <?php else : ?>
                                <?php foreach ($options->getData() as $option) : ?>
                                    <option value="<?php echo $option->optionId ?>" <?php if ($option->optionId == $product->$attribute1) : echo 'selected'; ?> <?php endif; ?>><?php echo $option->name ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </tr>
                <?php break; ?>
            <?php
            case 'checkbox': ?>
                <tr>
                    <div class="form-group row container">
                        <label class="col-md-12" for=""><?php echo  $attribute->name;
                                                        $attribute2 = $attribute->code ?></label>
                        <?php if (!$options) : ?>

                        <?php else : ?>
                            <?php foreach ($options->getData() as $option) : ?>
                                <div class="col-md-12">
                                    <input name="data[<?php echo $product->productId ?>][<?php echo $attribute->code ?>][<?php echo $option->optionId ?>]" type="checkbox" value="<?php echo $option->optionId ?>" <?php if ($option->optionId == $product->$attribute2) : echo 'checked'; ?> <?php endif; ?>> <?php echo $option->name ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </tr>
                <?php break; ?>
            <?php
            case 'radio': ?>
                <tr>
                    <div class="form-group row container">
                        <label class="col-md-12" for=""><?php echo  $attribute->name;
                                                        $attribute3 = $attribute->code ?></label>
                        <?php if (!$options) : ?>

                        <?php else : ?>
                            <?php foreach ($options->getData() as $option) : ?>
                                <div class="col-md-12">
                                    <input name="data[<?php echo $product->productId ?>][<?php echo $attribute->code ?>][<?php echo $option->optionId ?>]" type="radio" value="<?php echo $option->optionId ?>" <?php if ($option->optionId == $product->$attribute3) : echo 'checked'; ?> <?php endif; ?>> <?php echo $option->name ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </tr>
                <?php break; ?>
            <?php
            case 'text': ?>
                <tr>
                    <div class="form-group row container">
                        <label class="col-md-12" for=""><?php echo $attribute->name;
                                                        $attribute4 = $attribute->code ?></label>
                        <input class="col-md-12" name="data[<?php echo $product->productId ?>][<?php echo $attribute->code ?>]" type="text" value="<?php echo $product->$attribute4; ?>">
                    </div>
                </tr>
                <?php break; ?>
            <?php
            default: ?>

                <?php break; ?>
        <?php endswitch; ?>
    </tbody>
</table>