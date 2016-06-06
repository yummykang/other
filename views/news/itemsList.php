<?php echo $this->context->renderPartial('_copyright'); ?>
<table>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>date</th>
    </tr>
    <?php foreach ($newsList as $item) { ?>
        <tr>
            <td>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['news/item-detail', 'id' => $item['id']]) ?>">
                    <?php echo $item['id'] ?>
                </a>
            </td>
            <td>
                <?php echo $item['title'] ?>
            </td>
            <td><?php echo Yii::$app->formatter->asDatetime($item['date'], 'php:y/m/d') ?></td>
        </tr>
    <?php } ?>
</table>
