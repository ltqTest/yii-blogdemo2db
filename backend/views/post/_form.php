<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

    <?php
    // 方法一：
    // $psObjs = \common\models\Poststatus::find()->all();
    // $allStatus = \yii\helpers\ArrayHelper::map($psObjs, 'id', 'name');
    // 方法二：
    // $psArr = Yii::$app->db->createCommand('SELECT id,name FROM poststatus')->queryAll();
    // $allStatus = \yii\helpers\ArrayHelper::map($psArr, 'id', 'name');
    // 方法三：QueryBuilder利用查询构建器
    //    $allStatus = (new \yii\db\Query())
    //        ->select(['name', 'id'])
    //        ->from('poststatus')
    //        ->indexBy('id')
    //        ->column();
    // 方法四：
    $statusObj = \common\models\Poststatus::find()
        ->select(['name', 'id'])
        ->orderBy(['position' => SORT_DESC])
        ->indexBy('id')
        ->column();
    ?>
    <?= $form->field($model, 'status')->dropDownList($statusObj, ['prompt' => '请选择状态']) ?>

    <?php
    $authorObj = \common\models\Adminuser::find()
        ->select(['nickname', 'id'])
        ->indexBy('id')
        ->column();
    ?>
    <?= $form->field($model, 'author_id')->dropDownList($authorObj, ['prompt' => '请选择作者']) ?>

    <div class="form-group">
        <?= Html::submitButton('新增', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
