<?php

namespace backend\controllers;

use backend\models\ResetpwdForm;
use backend\models\SignupForm;
use common\models\AuthAssignment;
use common\models\AuthItem;
use Yii;
use common\models\AdminUser;
use common\models\AdminUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminUserController implements the CRUD actions for AdminUser model.
 */
class AdminUserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AdminUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminUser model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdminUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                return $this->redirect(['view']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionResetpwd($id)
    {
        $model = new ResetpwdForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->resetPassword($id)) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('resetpwd', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AdminUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdminUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdminUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrivilege($id)
    {
        // 给权限checkboxList选项赋值
        $allPrivileges = AuthItem::find()->select(['name', 'description'])->where(['type' => 1])->orderBy('description')->all();
        foreach ($allPrivileges as $privilege) {
            $allPrivilegeArr[$privilege->name] = $privilege->description;
        }
        // 获取当前用户权限使得checkboxList默认勾选
        $authAssignments = AuthAssignment::find()->select(['item_name'])->where(['user_id' => $id])->all();
        $authAssignmentsArr = array();
        foreach ($authAssignments as $authAssignment) {
            array_push($authAssignmentsArr, $authAssignment->item_name);
        }

        // 获取表单权限数据，更新auth_assignment表[变更用户所属角色进而操作权限]
        if (isset($_POST['newPri'])) {
            AuthAssignment::deleteAll('user_id=:id', ['id' => $id]);
            $newPri = $_POST['newPri'];
            $arrLength = count($newPri);
            for ($i = 0; $i < $arrLength; $i++) {
                $aPri = new AuthAssignment();
                $aPri->item_name = $newPri[$i];
                $aPri->user_id = $id;
                $aPri->created_at = time();
                $aPri->save();
            }

            return $this->redirect(['index']);
        }

        // 渲染checkboxList表单
        return $this->render('privilege', ['id' => $id, 'authAssignmentsArr' => $authAssignmentsArr, 'allPrivileges' => $allPrivilegeArr]);
    }
}
