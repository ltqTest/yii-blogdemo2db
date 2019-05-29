<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(
        [
            'action' => ['post/detail', 'id' => $id, '#' => 'comments'],
            'method' => 'post'
        ]); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($commentModel, 'content')->textarea(['rows' => 6, 'resize' => 'none']) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('新增', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
