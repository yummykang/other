<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<p>
    <?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<form method="post" action="<?php echo Url::to(['index']) ?>">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"/>
    <div class="row">
        <div class="col-md-3">
            <label>楼层</label>
            <input type="text" name="floor"/>
        </div>
        <div class="col-md-3">
            <input type="submit" value="搜索" class="btn btn-primary"/>
        </div>
    </div>
</form>
<table class="table">
    <tr>
        <th>楼层</th>
        <th>房间号</th>
        <th>空调</th>
        <th>电视</th>
        <th>电话</th>
        <th>可用时间(默认格式的时间)</th>
        <th>可用时间(格式化后)</th>
        <th>租金(欧元/日)</th>
        <th>描述</th>
        <th>操作</th>
    </tr>
    <?php foreach ($rooms as $item) { ?>
        <tr>
            <td><?php echo $item['floor'] ?></td>
            <td><?php echo $item['room_number'] ?></td>
            <td><?php echo ($item['has_tv'] == 1) ? '有' : '没有' ?></td>
            <td><?php echo ($item['has_conditioner'] == 1) ? '有' : '没有' ?></td>
            <td><?php echo ($item['has_phone'] == 1) ? '有' : '没有' ?></td>
            <td><?php echo Yii::$app->formatter->asDate($item['available_from']) ?></td>
            <td><?php echo Yii::$app->formatter->asDate($item['available_from'], 'php:Y-m-d') ?></td>
            <td><?php echo Yii::$app->formatter->asCurrency($item['price_per_day'], 'EUR') ?></td>
            <td><?php echo $item['description'] ?></td>
            <th>
                <a href="<?php echo Url::to('detail?id=' . $item->id) ?>">查看</a>|
                <a href="<?php echo Url::to('update?id=' . $item->id) ?>">修改</a>
            </th>
        </tr>
    <?php } ?>
</table>