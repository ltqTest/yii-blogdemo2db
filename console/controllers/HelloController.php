<?php

namespace console\controllers;

use common\models\Post;
use yii\console\Controller;

class HelloController extends Controller
{
    public $rev;

    public function options($id)
    {
        return ['rev'];
    }

    public function optionAliases()
    {
        return ['r' => 'rev'];
    }

    public function actionIndex()
    {
        if ($this->rev == 1) {
            echo strrev("Hello World") . "\n";
        } else {
            echo "Hello World\n";
        }
    }

    public function actionList()
    {
        $posts = Post::find()->all();
        foreach ($posts as $post) {
            echo $post['id'] . " - " . $post['title'] . "\n";
        }
    }

    public function actionWho($name)
    {
        echo "Hello " . $name . "\n";
    }

    public function actionBoth($name, $age)
    {
        echo "名字为：" . $name . "年龄为：" . $age;

    }

    public function actionAll(array $names)
    {
        var_dump($names);
    }
}