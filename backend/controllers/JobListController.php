<?php

namespace backend\controllers;

use Yii;
use common\models\JobList;
use backend\models\JobListSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * JobListController implements the CRUD actions for JobList model.
 */
class JobListController extends \backend\components\GenericController {

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
        $companyModel = \common\models\UserProfile::find()->where(['user_id' => Yii::$app->user->id])->one()->company;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, false, $companyModel->id);

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
        if($modelJobApplication->save()){
            $from = $modelJobApplication->user_id;
            $list_of_to = JobList::find()
                    ->select(['d.id','job_list.position'])
                    ->innerJoin('job_application b','job_list.id=b.job_list_id')
                    ->innerJoin('company_profile c','job_list.company_id=c.id')
                    ->innerJoin('user d','c.user_id=d.id')
                    ->where(['job_list.id' => $modelJobApplication->job_list_id])
                    ->all();
            
            foreach ($list_of_to as $to){
                $notificationModel = new \common\models\Notification();
                $notificationModel->from = $from;
                $notificationModel->to = $to->id;
                $notificationModel->message = "I am applying a job as a " . $to->position . " at your company.";
                $notificationModel->path = "job-list/view&id=".$id;
                $notificationModel->save();
            }
        }
        return $this->redirect(['application']);
    }

    /**
     * Displays a single JobList model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $companyModel = \common\models\CompanyProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $modelJobApplicationProvider = new ActiveDataProvider([
            'query' => \common\models\JobApplication::find()
                    ->innerJoin('job_list a', 'a.id=job_application.job_list_id')
                    ->where(['a.company_id' => $companyModel->id, 'job_application.job_list_id' => $id])
                    ->orderBy(['job_application.created_at' => SORT_DESC,'job_application.status' => SORT_ASC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'modelJobApplicationProvider' => $modelJobApplicationProvider,
        ]);
    }

    /**
     * Displays a single JobList model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewApplication($id) {
        return $this->render('view_application', [
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
        $companyModel = \common\models\UserProfile::find()->where(['user_id' => Yii::$app->user->id])->one()->company;
        $model->company_id = $companyModel->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->skills_require = implode(',', $model->skills_require);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->skills_require = implode(',', $model->skills_require);
            $model->save();
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

    public function actionAcceptApplication($id) {
        $jobApplicationModel = \common\models\JobApplication::findOne($id);
        $jobApplicationModel->status = 2;
        if($jobApplicationModel->save()){
            $notificationModel = new \common\models\Notification();
            $notificationModel->from = Yii::$app->user->id;
            $notificationModel->to = $jobApplicationModel->user_id;
            $notificationModel->message = 'Congratulations!! You have been selected to join us.';
            $notificationModel->path = 'job-list/view-application&id='.$jobApplicationModel->job_list_id;
            $notificationModel->save();
        }
        $this->redirect(['job-list/view', 'id' => $jobApplicationModel->job_list_id]);
    }

    public function actionRejectApplication($id) {
        $jobApplicationModel = \common\models\JobApplication::findOne($id);
        $jobApplicationModel->status = 1;
        if($jobApplicationModel->save()){
            $notificationModel = new \common\models\Notification();
            $notificationModel->from = Yii::$app->user->id;
            $notificationModel->to = $jobApplicationModel->user_id;
            $notificationModel->message = "We are sorry as your qualification did not meet our expectation.";
            $notificationModel->path = 'job-list/view-application&id='.$jobApplicationModel->job_list_id;
            $notificationModel->save();
        }
        $this->redirect(['job-list/view', 'id' => $jobApplicationModel->job_list_id]);
    }

}
