<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = $model->post->title;
$this->params['breadcrumbs'][] = ['label' => '评论管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->post->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comment-view">

    <h1>文章标题：<?= Html::encode($model->post->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除这条记录么？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content:ntext',
            [
                'attribute' => 'status',
                'value' => $model->status0->name
            ],
            [
                'attribute' => 'create_time',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'userid',
                'value' => $model->user->username
            ],
            'email:email',
            'url:url',
            [
                'attribute' => 'post_id',
                'label' => '文章标题',
                'value' => $model->post->title,
            ],
        ],
    ]) ?>

</div>
