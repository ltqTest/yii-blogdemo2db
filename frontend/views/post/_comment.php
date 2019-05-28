<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php foreach ($comments as $comment): ?>
    <div class="comment">
        <div class="row">
            <div class="col-md-12">
                <div class="comment_detail"></div>
                <p class="bg-info">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <em><?= Html::encode($comment->user->username); ?></em>
                    <br>
                    <?= nl2br($comment->content); ?>
                    <br>
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                    <em><?= date('Y-m-d H:i:s'); ?></em>
                </p>
            </div>
        </div>
    </div>
<?php endforeach; ?>