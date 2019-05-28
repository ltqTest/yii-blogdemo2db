<?php

use yii\helpers\Html;

?>

<div class="post">
    <div class="title">
        <h2><a href="<?= $model->url //Getter              ?>"><?= Html::encode($model->title) ?></a></h2>

        <div class="author">
            <span class="glyphicon glyphicon-time"
                  aria-hidden="true"><?= date('Y-m-d H:i:s', $model->create_time) ?></span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class="glyphicon glyphicon-user"
                  aria-hidden="true"><?= Html::encode($model->author->nickname) ?></span>
        </div>
        <br>
        <div class="content">
            <?= $model->beginning //Getter              ?>
        </div>

        <div class="nav">
            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
            <?= implode(', ', $model->tagLinks) // Getter         ?>
            <br>
            <?= Html::a("评论({$model->commentCount})", $model->url . '#comments') // Getter      ?>
            <span>最后修改时间：<?= date('Y-m-d H:i:s', $model->update_time) ?></span>
        </div>
    </div>
</div>
