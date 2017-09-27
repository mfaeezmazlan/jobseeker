<?php

namespace backend\controllers;

use Yii;
use common\models\JobList;
use backend\models\JobListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JobListController implements the CRUD actions for JobList model.
 */
class JobListController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all JobList models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new JobListSearch();
        $companyModel = \common\models\CompanyProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $companyModel->id);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all JobList models for application.
     * @return mixed
     */
    public function actionApplication() {
        $searchModel = new JobListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('application', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    
    /**
     * Apply job
     * @return mixed
     */
    public function actionApply($id) {
        $modelJobApplication = new \common\models\JobApplication();
        $modelJobApplication->job_list_id = $id;
        $modelJobApplication->user_id = Yii::$app->user->identity->id;
        $modelJobApplication->save();
        return $this->redirect(['application']);
    }
    
    /**
     * Displays a single JobList model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new JobList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new JobList();
        $modelJobSkills = new \common\models\JobListSkills();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'modelJobSkills' => $modelJobSkills,
            ]);
        }
    }

    /**
     * Updates an existing JobList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing JobList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JobList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JobList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = JobList::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
