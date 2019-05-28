<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // 添加 "createPost" 权限
        $createPost = $auth->createPermission('createPost');
        $createPost->description = '新增文章';
        $auth->add($createPost);

        // 添加 "updatePost" 权限
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = '修改文章';
        $auth->add($updatePost);

        // 添加 "deletePost" 权限
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = '删除文章';
        $auth->add($deletePost);

        // 添加 "approveComment" 权限
        $approveComment = $auth->createPermission('approveComment');
        $approveComment->description = '审核评论';
        $auth->add($approveComment);

        // 添加 "postAdmin" 角色[文章管理员]
        $postAdmin = $auth->createRole('postAdmin');
        $postAdmin->description = '文章管理员';
        $auth->add($postAdmin);
        $auth->addChild($postAdmin, $createPost);
        $auth->addChild($postAdmin, $updatePost);
        $auth->addChild($postAdmin, $deletePost);

        // 添加 "postOperator" 角色[文章操作员]
        $postOperator = $auth->createRole('postOperator');
        $postOperator->description = '文章操作员';
        $auth->add($postOperator);
        $auth->addChild($postOperator, $deletePost);

        // 添加 "commentAdmin" 角色[评论管理员]
        $commentAuditor = $auth->createRole('commentAuditor');
        $commentAuditor->description = '评论审核员';
        $auth->add($commentAuditor);
        $auth->addChild($commentAuditor, $approveComment);


        // 添加 "webMaster" 角色[系统管理员]
        $webMaster = $auth->createRole('webMaster');
        $webMaster->description = '系统管理员';
        $auth->add($webMaster);
        $auth->addChild($webMaster, $postAdmin);
        $auth->addChild($webMaster, $commentAuditor);


        // 为用户指派角色。其中 1 和 2 是由 IdentityInterface::getId() 返回的id
        // 通常在你的 User 模型中实现这个函数。
        $auth->assign($webMaster, 1);
        $auth->assign($postAdmin, 2);
        $auth->assign($postOperator, 3);
        $auth->assign($commentAuditor, 7);

    }
}