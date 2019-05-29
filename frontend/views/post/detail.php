<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = '文章列表';
//$this->params['breadcrumbs'][] = $this->title;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h2><?= Html::a($model->title, $model->url) ?></h2>

            <div class="author">
                <?= Html::tag('span', date('Y-m-d H:i:s', $model->create_time), ['class' => 'glyphicon glyphicon-time', 'aria-hidden' => 'true']) ?>
                <?= Html::tag('span', $model->author->nickname, ['class' => 'glyphicon glyphicon-user', 'aria-hidden' => 'true']) ?>
            </div>

            <?= HTMLPurifier::process($model->content) ?>
            <br>

            <div class="nav">
                <?= Html::tag('span', '', ['class' => 'glyphicon glyphicon-tags', 'aria-hidden' => 'true']) ?>

                <?= implode(', ', $model->tagLinks) // Getter                               ?>
                <br>
                <?= Html::a("评论({$model->commentCount})", $model->url . '#comments') // Getter                            ?>
                <?= Html::tag('span', '最后修改时间：' . date('Y-m-d H:i:s', $model->update_time)) ?>
            </div>

            <div class="comment">
                <?php if ($added) { ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <strong>谢谢您的回复!我们会尽快审核后发布出来.</strong>
                        <?= Html::tag('p', nl2br($commentModel->content)) ?>
                        <?= Html::tag('span', date('Y-m-d H:i:s', $model->create_time), ['class' => 'glyphicon glyphicon-time', 'aria-hidden' => 'true']) ?>
                        <?= Html::tag('span', $model->author->nickname, ['class' => 'glyphicon glyphicon-user', 'aria-hidden' => 'true']) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    </div>

                <?php } ?>

                <?php if ($model->commentCount >= 1): ?>
                    <h5><?= $model->commentCount . '条评论'; ?></h5>
                    <?= $this->render('_comment', [
                        'post' => $model,
                        'comments' => $model->activeComments,
                    ]); ?>
                <?php endif; ?>
                <h2>发表评论</h2>
                <?php
                $postComment = new \common\models\Comment();
                echo $this->render('_guestform', [
                    'id' => $model->id,
                    'commentModel' => $commentModel,
                ]);
                ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="searchbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;查找文章
                    </li>
                    <li class="list-group-item">
                        <form class="form-inline" action="index.php?r=post/index" id="w0" method="get">
                            <div class="form-group">
                                <input type="text" name="PostSearch[title]" class="form-control" id="w0input"
                                       placeholder="请按标题进行搜索">
                            </div>
                            <button type="submit" class="btn btn-default">搜索</button>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="tagcloudbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>&nbsp;&nbsp;标签云
                    </li>
                    <li class="list-group-item">
                        <?= \frontend\components\TagsCloudWidget::widget(['tags' => $tags]) ?>
                    </li>
                </ul>
            </div>

            <div class="commentbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>&nbsp;&nbsp;最近回复
                    </li>
                    <li class="list-group-item">
                        <?= \frontend\components\RctReplyWidget::widget(['recentComments' => $recentComments]) ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
