<?php $media = $this->getMedia() ?>

<div class="container">

    <div id="title" class="d-flex">
        <b>Media</b>
        <button type="button" onclick="mage.setForm(this).setUrl('<?php echo $this->getUrl('update', 'admin_Product_Media', null, true) ?>').load();" class="ml-auto">Update</button>
        <button type="button" onclick="mage.setForm(this).setUrl('<?php echo $this->getUrl('remove', 'admin_Product_Media', null, true) ?>').load();" class="ml-3 mr-3">Remove</button>
    </div>
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">IMAGE</th>
                    <th scope="col">LABEL</th>
                    <th scope="col">SMALL</th>
                    <th scope="col">THUMB</th>
                    <th scope="col">BASE</th>
                    <th scope="col">GALLERY</th>
                    <th scope="col">REMOVE</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$media) : ?>
                    <tr>
                        <td colspan="3">No Media Available</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($media->getData() as $row) : ?>
                        <tr>
                            <td><img style="width: 75px; height:75px" src="<?php echo 'skin/admin/product/image/' . $row->image ?>" alt="hello"></td>
                            <td><input type="text" placeholder="Enter Lable" name="media[data][<?php echo $row->mediaId ?>][lebel]" value="<?php echo $row->label ?>"></td>
                            <td><input value="<?php echo $row->mediaId ?>" type="radio" name="media[small]" <?php if ($row->small == 1) : echo 'checked' ?> <?php endif; ?>></td>
                            <td><input value="<?php echo $row->mediaId ?>" type="radio" name="media[thumb]" <?php if ($row->thumb == 1) : echo 'checked' ?> <?php endif; ?>></td>
                            <td><input value="<?php echo $row->mediaId ?>" type="radio" name="media[base]" <?php if ($row->base == 1) : echo 'checked' ?> <?php endif; ?>></td>
                            <td><input value="<?php echo $row->mediaId ?>" type="checkbox" name="media[data][<?php echo $row->mediaId ?>][gallery]" <?php if ($row->gallery == 1) : echo 'checked' ?> <?php endif; ?>></td>
                            <td><input value="<?php echo $row->mediaId ?>" type="checkbox" name="media[remove][<?php echo $row->mediaId ?>]"></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div id="title" class="d-flex">
        <input type="file" name="img[image]" id="upload-image" required>
        <button type="button" onclick="mage.setFile(this,'#upload-image').setUrl('<?php echo $this->getUrl('test', 'admin_Product_Media', null, true) ?>').uploadFile();" name="send" class="btn btn-success" value="Save">Upload</button>
    </div>
</div>