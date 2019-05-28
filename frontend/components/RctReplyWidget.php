<?php

namespace frontend\components;

use yii\Base\Widget;
use yii\helpers\Html;

class RctReplyWidget extends Widget
{
    public $recentComments;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $commentStr = '';

        foreach ($this->recentComments as $comment) {
            $commentStr .= '<div class="post">' .
                '<div class="title">' .
                '<p style=""color:#777;font-style:talic;">' .
                nl2br($comment->content) . '</p>' .
                '<p class=""text"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;' .
                Html::encode($comment->user->username) . ' </p > ' .
                '<p style = ""font - size:8pt;color:bule">文章《<a href="' . $comment->post->url . '">' . Html::encode($comment->post->title) . '</a>》' .
                '<hr></div></div>';
        }
        return $commentStr;
    }
}