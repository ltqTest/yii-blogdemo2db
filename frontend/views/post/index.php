<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <?=
            \yii\widgets\ListView::widget([
                'id' => 'postList',
                'dataProvider' => $dataProvider,
                'itemView' => '_listitem',//子视图，显示一篇文章的内容
                'pager' => [
                    'maxButtonCount' => 10,
                    'nextPageLabel' => Yii::t('app', '下一页'),
                    'prevPageLabel' => Yii::t('app', '上一页'),
                ],
            ])
            ?>
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
