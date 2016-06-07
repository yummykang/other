<table class="table">
    <tr>
        <th>楼层</th>
        <td><?php use yii\helpers\Html;
            use yii\helpers\Url;

            echo $room['floor'] ?></td>
    </tr>
    <tr>
        <th>房间号</th>
        <td><?php echo $room['room_number'] ?></td>
    </tr>
    <tr>
        <th>空调</th>
        <td><?php echo ($room['has_conditioner'] == 1) ? '有' : '没有' ?></td>
    </tr>
    <tr>
        <th>电视</th>
        <td><?php echo ($room['has_tv'] == 1) ? '有' : '没有' ?></td>
    </tr>
    <tr>
        <th>电话</th>
        <td><?php echo ($room['has_phone'] == 1) ? '有' : '没有' ?></td>
    </tr>
    <tr>
        <th>可用时间</th>
        <td><?php echo $room['available_from'] ?></td>
    </tr>
    <tr>
        <th>租金</th>
        <td><?php echo Yii::$app->formatter->asCurrency($room['price_per_day'], 'EUR') ?></td>
    </tr>
    <tr>
        <th>描述</th>
        <td><?php echo $room['description'] ?></td>
    </tr>
    <tr>
        <th>图片</th>
        <td><img src="<?php echo Url::to(Yii::getAlias('@filepath/').$room['file_image']) ?>" /></td>
    </tr>
    <tr>
        <td><?php echo Html::a('返回', ['index'], ['class' => 'btn btn-default']); ?></td>
    </tr>
</table>