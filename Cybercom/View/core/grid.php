<?php
$columns = $this->getColumns();
$collection = $this->getCollection();
$actions = $this->getActions();
$buttons = $this->getButtons();
$title = $this->getTitle();
?>

<div class="container">
    <div id="title">
        <b><?php echo $title ?></b>
    </div>
    <form action="" method="POST" enctype="multipart/form-data" novalidate>
        <?php if ($buttons) : ?>
            <?php foreach ($buttons as $button) : ?>
                <a class="<?php echo $button['class'] ?>" onclick="<?php $this->getButtonUrl($button['method']); ?>" href="javascript:void(0)"><?= $button['label'] ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
        <div>
            <table class="table">
                <thead class="thead-dark">
                    <?php if ($columns) : ?>
                        <tr>
                            <?php foreach ($columns as $column) : ?>
                                <th><?= $column['label'] ?></th>
                            <?php endforeach; ?>
                            <?php if ($actions) : ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <?php foreach ($columns as $column) : ?>
                                <td><input name="filter[<?= $column['type'] ?>][<?= $column['field'] ?>]" type="text" value="<?php echo $this->getFilter()->getFilterValue($column['type'], $column['field']); ?>"></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endif; ?>
                </thead>
                <tbody>
                    <?php if (!$collection) : ?>
                        <tr>
                            <td colspan="3">No Date Found.</td>
                        </tr>
                    <?php else :  ?>
                        <?php foreach ($collection->getData() as $row) : ?>
                            <tr class='disabled'>
                                <?php foreach ($columns as $column) : ?>
                                    <?php if ($column['type'] == 'image') : ?>
                                        <td><img style="width: 100px; height:75px" src="<?= $this->getFildValue($row, $column['field']) ?>" alt=""></td>
                                    <?php else : ?>
                                        <td><?= $this->getFildValue($row, $column['field']) ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if ($actions) : ?>
                                    <td>
                                        <?php foreach ($actions as $action) : ?>
                                            <?php if ($action['ajax']) : ?>
                                                <a class="<?php echo $action['class'] ?>" onclick="<?php $this->getMethodUrl($row, $action['method']); ?>" href="javascript:void(0)"><?= $action['label'] ?></a>
                                            <?php else : ?>
                                                <a href="<?php $this->getMethodUrl($row, $action['method']); ?>"><?= $action['label'] ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </form>
    <ul class="pagination">
        <li><button onclick="mage.setUrl('<?php echo $this->getUrl(null, null, ['p' => $this->getPager()->getPrevious()]) ?>').load()">Previous</button></li>
        <li><button onclick="mage.setUrl('<?php echo $this->getUrl(null, null, ['p' => $this->getPager()->getNext()]) ?>').load()">Next</button></li>
    </ul>
</div>