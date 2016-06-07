<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<?php $form = ActiveForm::begin(['id' => 'room-form']) ?>
<?php echo $form->field($model, 'floor')->textInput(); ?>
<?php echo $form->field($model, 'room_number')->textInput(); ?>
<?php echo $form->field($model, 'has_conditioner')->checkbox(); ?>
<?php echo $form->field($model, 'has_tv')->checkbox(); ?>
<?php echo $form->field($model, 'has_phone')->checkbox(); ?>
<?php echo $form->field($model, 'available_from')->textInput(); ?>
<?php echo $form->field($model, 'price_per_day')->textInput(); ?>
<?php echo $form->field($model, 'description')->textArea(); ?>
<?php echo $form->field($model, 'file_image')->fileInput(); ?>
<?php echo Html::submitButton('保存', ['class' => 'btn btn-primary']); ?>
&nbsp;&nbsp;
<?php echo Html::a('返回', ['index'], ['class' => 'btn btn-default']); ?>
<?php ActiveForm::end() ?>