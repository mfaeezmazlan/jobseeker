<?php

namespace backend\controllers;

use Yii;
use common\models\UserProfile;
use backend\models\UserProfileSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * UserProfileController implements the CRUD actions for UserProfile model.
 */
class UserProfileController extends \backend\components\GenericController {

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
                        'actions' => ['create', 'index', 'view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['my-profile', 'display-skills', 'download-attachment', 'update-profile-pic'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view-profile'],
                        'roles' => ['company', 'admin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['employee'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update-staff-profile'],
                        'roles' => ['company'],
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
     * Lists all UserProfile models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserProfile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new UserProfile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate() {
        $model = $this->findModel(Yii::$app->user->id);
        $modelAddress = $model->address;
        $modelAttachment = new \common\models\DocAttach();
        $modelAttachment->scenario = 'updateResume';
        $readAttachment = null;
        if ($modelUserDoc = \common\models\UserDoc::find()->where(['user_id' => Yii::$app->user->identity->id])->orderBy(['id' => SORT_DESC])->one()) {
            $readAttachment = \common\models\DocAttach::findOne($modelUserDoc->doc_attach_id);
        }

        if ($model->load(Yii::$app->request->post()) && $modelAddress->load(Yii::$app->request->post())) {
            if (is_array($model->skills))
                $model->skills = implode(',', $model->skills);
            else
                $model->skills = null;
            if (is_array($model->language))
                $model->language = implode(',', $model->language);
            else
                $model->language = null;
            if (is_array($model->leadership_experience))
                $model->leadership_experience = implode(',', $model->leadership_experience);
            else
                $model->leadership_experience = null;

            if ($model->save()) {
                \common\components\FileHandler::generate($modelAttachment, Yii::$app->user->id);
                $modelAddress->save();
                return $this->redirect(['my-profile']);
            }
        }
        return $this->render('update', [
                    'model' => $model,
                    'modelAddress' => $modelAddress,
                    'modelAttachment' => $modelAttachment,
                    'readAttachment' => $readAttachment,
        ]);
    }

    public function actionUpdateStaffProfile() {
        $model = $this->findModel(Yii::$app->user->id);
        $modelCompany = $model->company;
        $modelAddress = [
            'user' => $model->address,
            'company' => $modelCompany->address
        ];

        if ($model->load(Yii::$app->request->post()) && $modelCompany->load(Yii::$app->request->post())
//                && $modelCompanyAddress->load(Yii::$app->request->post()) 
//                && $modelAddress->load(Yii::$app->request->post())
                && \yii\base\Model::loadMultiple($modelAddress, Yii::$app->request->post())) {

//            $modelAddress = $modelAddress['user'];
//            $modelCompanyAddress = $modelAddress['company'];

            if ($model->save()) {
                $modelCompany->save();
                foreach ($modelAddress as $x) {
                    $x->save();
                }
                return $this->redirect(['my-profile']);
            }
        }
        return $this->render('update_staff_profile', [
                    'model' => $model,
                    'modelCompany' => $modelCompany,
                    'modelAddress' => $modelAddress
        ]);
    }

    /**
     * Deletes an existing UserProfile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUpdateProfilePic() {
        $modelUserProfile = $this->findModel(Yii::$app->user->id);
        $modelAttachment = new \common\models\DocAttach();
        $modelAttachment->scenario = 'updateProfilePic';
        foreach ($_FILES as $cat => $file) {
            $filetype = $file['type']['file'];
        }
        $modelAttachment->file = UploadedFile::getInstance($modelAttachment, 'file');

        $modelAttachment->file_name = $modelAttachment->file->name;
        $modelAttachment->file_name_sys = Yii::$app->user->id . "_" . date('d-m-Y_H_i_s') . "." . $modelAttachment->file->extension;
        $modelAttachment->file_type = $filetype;

        $path = Yii::getAlias('@backend') . "/web/uploads/resume/$modelUserProfile->user_id";
        if (!is_dir($path)) {
            mkdir($path, 0755);
        }

        $modelAttachment->doc_title = $modelAttachment->file->name;
        $modelAttachment->file->saveAs("$path/" . $modelUserProfile->user_id . "_" . date('d-m-Y_H_i_s') . "." . $modelAttachment->file->extension);
        $modelAttachment->file = "$path/" . Yii::$app->user->id . "_" . date('d-m-Y_H_i_s') . "." . $modelAttachment->file->extension;
        if ($modelAttachment->save()) {
            $modelUserProfile->profile_pic_id = $modelAttachment->id;
            $modelUserProfile->save();
        }

        return $this->redirect(['my-profile']);
    }

    public function actionMyProfile() {
        $cookies = Yii::$app->response->cookies;
        $cookies->remove('menuToOpen');
        $cookies->remove('nav_open');
        unset($cookies['menuToOpen']);
        unset($cookies['nav_open']);

        $assignmentRole = \common\models\AuthAssignment::find()->where(['user_id' => Yii::$app->user->identity->id])->one()->item_name;

        switch ($assignmentRole) {
            case 'employee':
                $modelUserProfile = $this->findModel(Yii::$app->user->identity->id);

                $modelUserProfileAttachment = new \common\models\DocAttach();
                $readAttachment = null;
                if ($modelUserProfile->profile_pic_id != 0) {
                    $readAttachment = \common\models\DocAttach::findOne($modelUserProfile->profile_pic_id);
                }

                return $this->render('profile', [
                            'model' => $modelUserProfile,
                            'modelUserProfileAttachment' => $modelUserProfileAttachment,
                            'readAttachment' => $readAttachment,
                ]);
            case 'company':
                $userProfileModel = $this->findModel(Yii::$app->user->id);
                $companyProfile = $userProfileModel->company;

                $modelUserProfileAttachment = new \common\models\DocAttach();
                $readAttachment = null;
                if ($userProfileModel->profile_pic_id != 0) {
                    $readAttachment = \common\models\DocAttach::findOne($userProfileModel->profile_pic_id);
                }

                return $this->render('company_profile', [
                            'model' => $userProfileModel,
                            'companyProfile' => $companyProfile,
                            'modelUserProfileAttachment' => $modelUserProfileAttachment,
                            'readAttachment' => $readAttachment,
                ]);
            case 'admin':
            default:
                return $this->redirect(['site/index']);
        }
    }

    public function actionViewProfile($id) {
        return $this->render('view_profile', [
                    'model' => $this->findModel($id),
                    'user_id' => $id,
        ]);
    }

    public function actionDisplaySkills($counter) {
        $model = new UserProfile();

        return $this->renderAjax('addSkills', [
                    'counter' => $counter,
                    'model' => $model
        ]);
    }

    /**
     * Finds the UserProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = UserProfile::findOne(['user_id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDownloadAttachment($id, $user_id) {
        $modelAttachment = \common\models\DocAttach::findOne($id);
        $path = Yii::getAlias('@backend') . "/web/uploads/resume/" . $user_id . "/" . $modelAttachment->file_name_sys;
        echo $path;
        if (file_exists($path)) {
//            header('Content-Type:' . $att->doctype);
            header("Content-Disposition: attachment; filename={$modelAttachment->file_name}");
            readfile($path);
        }
    }

}
