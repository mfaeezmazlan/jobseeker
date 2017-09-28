<?php

namespace backend\controllers;

use Yii;
use common\models\UserProfile;
use backend\models\UserProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserProfileController implements the CRUD actions for UserProfile model.
 */
class UserProfileController extends Controller {

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
                        'actions' => ['create', 'update', 'index', 'view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['my-profile', 'display-skills'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view-profile'],
                        'roles' => ['company', 'admin'],
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
        $fileName = null;
        if ($modelUserDoc = \common\models\UserDoc::find()->where(['user_id' => Yii::$app->user->identity->id])->orderBy(['id' => SORT_DESC])->one()) {
            $fileName = \common\models\DocAttach::findOne($modelUserDoc->doc_attach_id)->file_name;
        }

        if ($model->load(Yii::$app->request->post()) && $modelAddress->load(Yii::$app->request->post())) {
            $model->skills = implode(',', $model->skills);
            $model->language = implode(',', $model->language);
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
                    'fileName' => $fileName,
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

    public function actionMyProfile() {
        return $this->render('profile', [
                    'model' => $this->findModel(Yii::$app->user->identity->id),
        ]);
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

}
