<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends \backend\components\GenericController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'get-country', 'get-state'],
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
        $assignmentRole = \common\models\AuthAssignment::find()->where(['user_id' => Yii::$app->user->identity->id])->one()->item_name;

        switch ($assignmentRole) {
            case 'employee':
                $modelJobList = \common\models\JobList::find()->orderBy(['created_at' => SORT_DESC])->limit(4)->all();
                return $this->render('index_employee', ['modelJobList' => $modelJobList]);
            case 'company':
                $companyModel = \common\models\CompanyProfile::find()->where(['user_id' => Yii::$app->user->id])->one();
                $totalPendingApplication = count(\common\models\JobApplication::find()
                                ->innerJoin('job_list a', 'a.id=job_application.job_list_id')
                                ->where(['a.company_id' => $companyModel->id, 'status' => 0])->all());
                $totalJobList = count(\common\models\JobList::find()->where(['company_id' => $companyModel->id])->all());

                $totalUser = count(\common\models\AuthAssignment::find()->where(['item_name' => 'employee'])->all());
                $totalUserCompany = count(\common\models\AuthAssignment::find()->where(['item_name' => 'company'])->all());
                $totalUserAdmin = count(\common\models\AuthAssignment::find()->where(['item_name' => 'admin'])->all());
                return $this->render('index_company', [
                            'totalUser' => $totalUser,
                            'totalUserCompany' => $totalUserCompany,
                            'totalUserAdmin' => $totalUserAdmin,
                            'totalPendingApplication' => $totalPendingApplication,
                            'totalJobList' => $totalJobList,
                ]);
            case 'admin':
            default:
                $totalUser = count(\common\models\AuthAssignment::find()->where(['item_name' => 'employee'])->all());
                $totalUserCompany = count(\common\models\AuthAssignment::find()->where(['item_name' => 'company'])->all());
                $totalUserAdmin = count(\common\models\AuthAssignment::find()->where(['item_name' => 'admin'])->all());
                $totalPendingApplication = count(\common\models\JobApplication::find()->where(['status' => 0])->all());
                $totalJobList = count(\common\models\JobList::find()->all());

                // Get DB Usage
                $sql = "SELECT table_schema, SUM((data_length+index_length)/1024/1024) AS MB FROM information_schema.tables WHERE table_schema='jobseeker' GROUP BY 1";
                $connection = Yii::$app->getDb();
                $command = $connection->createCommand($sql);
                $result = $command->queryAll();
                $totalMySqlUsage = number_format($result[0]['MB'], 3, '.', '');
                $totalFreeDiskSpace = number_format((disk_free_space("C:") / 1024 / 1024 / 1024), 3, '.', '');

                return $this->render('index', [
                            'totalUser' => $totalUser,
                            'totalUserCompany' => $totalUserCompany,
                            'totalUserAdmin' => $totalUserAdmin,
                            'totalPendingApplication' => $totalPendingApplication,
                            'totalJobList' => $totalJobList,
                            'totalMySqlUsage' => $totalMySqlUsage,
                            'totalFreeDiskSpace' => $totalFreeDiskSpace,
                ]);
        }
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
                $modelAddress = new \common\models\Address();
                $modelAddress->type = 1;
                $modelAddress->country = 132;
                $modelAddress->street_1 = 'Street 1';
                $modelAddress->street_2 = 'Street 2';
                $modelAddress->save();

                $modelUserProfile = new \common\models\UserProfile();
                $modelUserProfile->first_name = $modelUser->username;
                $modelUserProfile->profile_pic_id = 0;
                $modelUserProfile->address_id = $modelAddress->id;
                $modelUserProfile->user_id = $modelUser->id;
                $modelUserProfile->save();

                $modelAuth = new \common\models\AuthAssignment();
                $modelAuth->user_id = $modelUser->id;
                $modelAuth->item_name = 'employee';
                $modelAuth->save(false);
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
        $cookies = Yii::$app->response->cookies;
        $cookies->remove('menuToOpen');
        $cookies->remove('nav_open');
        unset($cookies['menuToOpen']);
        unset($cookies['nav_open']);
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

    public function actionGetState($search = null, $page = 1) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $perPage = 20;
        $output['results'] = [];

        $query = \common\models\States::find()->orderBy(['name' => SORT_ASC]);
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
