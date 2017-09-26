<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'get-country'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $modelUser = new \backend\models\User();
        $modelUser->scenario = 'register';
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else if ($modelUser->load(Yii::$app->request->post()) && $modelUser->validate()) {

            $modelUser->status = 10;
            $modelUser->password_hash = $modelUser->repeat_password = $modelUser->password = Yii::$app->security->generatePasswordHash($modelUser->password);
            $modelUser->auth_key = Yii::$app->security->generateRandomString();
            if ($modelUser->save()) {
                $modelAuth = new \common\models\AuthAssignment();
                $modelAuth->user_id = $modelUser->id;
                $modelAuth->item_name = 'employee';
                $modelAuth->save();
            }
            return $this->goHome();
        } else {
            return $this->render('login', [
                        'model' => $model,
                        'modelUser' => $modelUser,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionGetCountry($search = null, $page = 1) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $perPage = 20;
        $output['results'] = [];

        $query = \common\models\Countries::find()->orderBy(['name' => SORT_ASC]);
        if (!is_null($search)) {
            $query->where(['like', 'name', '%' . $search . '%', false]);
        }

        $output['total'] = $query->count('id');
        $results = $query->limit($perPage)->offset(($page - 1) * $perPage)->all();
        foreach ($results as $result) {
            $output['results'][] = ['id' => $result->id, 'text' => $result->name];
        }

        return $output;
    }

}
