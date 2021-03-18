<table>
    <tbody>
        <tr class="row">
            <td class="col-md-2">
                <?php echo $this->getTabHtml(); ?>
            </td>
            <td class="col-md-10">
                <div class="container">
                    <form id="form" method="post" action="<?php echo $this->getUrl('save', null, null, true); ?>" enctype="multipart/form-data" novalidate>
                        <div id="tabsHtml">
                            <?php $this->getTabContent(); ?>
                        </div>
                    </form>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<script>
    CKEDITOR.replace('cms_page[content]');
</script>