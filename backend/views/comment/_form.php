<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <?php
    $statusObj = \common\models\Commentstatus::find()
        ->select(['name', 'id'])
        ->orderBy(['position' => SORT_DESC])
        ->indexBy('id')
        ->column();
    ?>
    <?= $form->field($model, 'status')->dropDownList($statusObj, ['prompt' => '请选择状态']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('新增', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
