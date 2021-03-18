<?php
$cmsPages = $this->getCmsPages();
?>
<div class="container">
    <div id="title">
        <b>Read Contacts</b>
        <hr style="border-color: black;">
    </div>
    <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, null) ?>').load();" href="javascript:void(0)" type="button" class="btn btn-success">Create CMS Page</a>
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Page ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Identifier </th>
                    <th scope="col">Content</th>
                    <th scope="col">createdDate</th>
                    <th scope="col">status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$cmsPages) : ?>
                <?php else : ?>
                    <?php foreach ($cmsPages->getData() as $cmsPage) : ?>
                        <tr>
                            <td><?php echo $cmsPage->pageId ?></td>
                            <td><?php echo $cmsPage->title ?></td>
                            <td><?php echo $cmsPage->identifier ?></td>
                            <td><?php echo $cmsPage->content ?></td>
                            <td><?php echo $cmsPage->createdDate ?></td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('status', null, ['id' => $cmsPage->pageId]) ?>').load();" href="javascript:void(0)" <?php if ($cmsPage->status) : echo 'class="btn btn-sm btn-primary"' ?><?php else : echo 'class="btn btn-sm btn-warning"' ?><?php endif; ?>><?php if ($cmsPage->status) : echo 'Disable' ?><?php else : echo "Enable" ?><?php endif; ?></a>
                            </td>
                            <td>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('form', null, ['id' => $cmsPage->pageId], true); ?>').load();" href="javascript:void(0)"><i class='fas fa-pencil-alt'></i></a>
                                <a onclick="mage.setUrl('<?php echo $this->getUrl('delete', null, ['id' => $cmsPage->pageId]) ?>').load();" class="ml-2" href="javascript:void(0)"><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>