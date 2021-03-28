<?php $cms_page = $this->getTableRow(); ?>

<div class="container">
    <div id="title">
        <b>CMS Pages</b>
    </div>
    <hr style="border-color: black;">
    <div class="first-btn">
        <div class="container">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Title</label> <span id="title1-info" class="invalid-feedback"></span>
                    <div class="input-group">
                        <input type="text" name="cms_page[title1]" id="title1" class="form-control" placeholder="Enter Title" value="<?php echo $cms_page->title1 ?>">
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label>Identifier</label> <span id="identifier-info" class=" invalid-feedback"></span>
                    <div class="input-group">
                        <textarea name="cms_page[identifier]" id="identifier" cols="60" rows="2" placeholder="Enter identifier"><?php echo $cms_page->identifier ?></textarea>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label>status</label> <span id="status-info" class=" invalid-feedback"></span>
                    <div class="input-group">
                        <select name="cms_page[status]" id="status">
                            <?php
                            foreach ($cms_page->getStatusOptions() as $key => $value) {
                            ?>
                                <option value="<?php echo $key ?>" <?php if ($key == $cms_page->status) echo ' selected="selected"'; ?>><?php echo $value ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-9">
                    <label>content</label> <span id="content-info" class=" invalid-feedback"></span>
                    <div class="input-group">
                        <textarea name="cms_page[content]" id="editor" cols="60" rows="2"><?php echo $cms_page->content ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input onclick="mage.setCms(this).load1();" type="button" name="send" class="btn btn-success" value="Save" />
                </div>
            </div>
        </div>
    </div>
</div>