<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use common\models\Address;
use common\models\UserProfile;
use common\models\AuthAssignment;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends \backend\components\GenericController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $modelAddress = $model->userProfile->address;
        $modelUserProfile = $model->userProfile;
        return $this->render('view', [
                    'model' => $model,
                    'modelUserProfile' => $modelUserProfile,
                    'modelAddress' => $modelAddress,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();
        $modelAddress = new Address();
        $modelUserProfile = new UserProfile();
        $modelAuth = new AuthAssignment();

        $modelAddress->type = 1;
        $oldPassword = $model->password_hash;
        if ($model->load(Yii::$app->request->post()) && $modelAddress->load(Yii::$app->request->post()) && $modelUserProfile->load(Yii::$app->request->post()) && $modelAuth->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status = 10;
            $model->password_hash = $model->password = Yii::$app->security->generatePasswordHash($model->password);
            $model->auth_key = Yii::$app->security->generateRandomString();

            if ($model->save()) {
                $modelAddress->type = 1;
                $modelAddress->save();
                $modelUserProfile->user_id = $modelAuth->user_id = $model->id;
                $modelUserProfile->address_id = $modelAddress->id;
                $modelUserProfile->profile_pic_id = 0;
                $modelUserProfile->save();
                $modelAuth->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'modelUserProfile' => $modelUserProfile,
                        'modelAddress' => $modelAddress,
                        'modelAuth' => $modelAuth,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelAddress = $model->userProfile->address;
        $modelUserProfile = $model->userProfile;
        $modelAuth = AuthAssignment::find()->where(['user_id' => $model->id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->password_hash = $model->password = Yii::$app->security->generatePasswordHash($model->password);
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'modelUserProfile' => $modelUserProfile,
                        'modelAddress' => $modelAddress,
                        'modelAuth' => $modelAuth,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
