<?php
$tabs = $this->getTabs();
foreach ($tabs as $key => $tab) { ?>
    <a onclick="mage.setUrl('<?php echo $this->getUrl(null, null, ['tab' => $key], true) ?>').load();" href="javascript:void(0)" class="btn btn-primary mt-2 col-md-12"><?php echo $tab['label'] ?></a>
<?php } ?>