<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = \common\models\Adminuser::findOne($id);
$this->title = '权限设置：' . $model->username;
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $id]];
$this->params['breadcrumbs'][] = '权限设置';
?>
<div class="admin-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="admin-user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= Html::checkboxList('newPri', $authAssignmentsArr, $allPrivileges); ?>

        <div class="form-group">
            <?= Html::submitButton('设置', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
