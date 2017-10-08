<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class TalentController extends \backend\components\GenericController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'search'],
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

    public function actionIndex() {
        $searchModel = new \backend\models\UserProfileSearch();

        $dataProvider = $searchModel->searchTalent(Yii::$app->request->queryParams);

        if (isset($_GET['UserProfileSearch'])) {
            return $this->render('indexResult', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider
            ]);
        }

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSearch() {
        $searchModel = new \backend\models\UserProfileSearch();
        $dataProvider = $searchModel->searchTalent(Yii::$app->request->queryParams);

        if (isset($_GET['UserProfileSearch'])) {
            $totalSearch = 0;
            $totalSkillsSearch = 0;
            $totalLanguageSearch = 0;
            $totalLeadershipExpSearch = 0;

            $skillsSearch = null;
            $languageSearch = null;
            $leadershipExpSearch = null;
            $qualificationSearch = null;
            $previousJobFieldSearch = null;
            $workingExperienceSearch = null;

            if (is_array($_GET['UserProfileSearch']['skills'])) {
                $totalSkillsSearch = count($_GET['UserProfileSearch']['skills']);
                $skillsSearch = implode(',', $_GET['UserProfileSearch']['skills']);
            }
            if (is_array($_GET['UserProfileSearch']['language'])) {
                $totalLanguageSearch = count($_GET['UserProfileSearch']['language']);
                $languageSearch = implode(',', $_GET['UserProfileSearch']['language']);
            }
            if (is_array($_GET['UserProfileSearch']['leadership_experience'])) {
                $totalLeadershipExpSearch = count($_GET['UserProfileSearch']['leadership_experience']);
                $leadershipExpSearch = implode(',', $_GET['UserProfileSearch']['leadership_experience']);
            }

            $totalSearch = $totalSkillsSearch + $totalLanguageSearch + $totalLeadershipExpSearch;

            if ($_GET['UserProfileSearch']['qualification']) {
                $totalSearch += 1;
                $qualificationSearch = $_GET['UserProfileSearch']['qualification'];
            }
            if ($_GET['UserProfileSearch']['previous_job_field']) {
                $totalSearch += 1;
                $previousJobFieldSearch = $_GET['UserProfileSearch']['previous_job_field'];
            }
            if ($_GET['UserProfileSearch']['working_experience']) {
                $totalSearch += 1;
                $workingExperienceSearch = $_GET['UserProfileSearch']['working_experience'];
            }

            $userProfileModel = \common\models\UserProfile::find()
                            ->innerJoin('auth_assignment a', 'a.user_id = user_profile.user_id')
                            ->where('a.item_name="employee"')->all();

            Yii::$app->session->set('totalSearch', $totalSearch);
            Yii::$app->session->set('totalSkillsSearch', $totalSkillsSearch);
            Yii::$app->session->set('totalLanguageSearch', $totalLanguageSearch);
            Yii::$app->session->set('totalLeadershipExpSearch', $totalLeadershipExpSearch);
            Yii::$app->session->set('skillsSearch', $skillsSearch);
            Yii::$app->session->set('languageSearch', $languageSearch);
            Yii::$app->session->set('leadershipExpSearch', $leadershipExpSearch);
            Yii::$app->session->set('qualificationSearch', $qualificationSearch);
            Yii::$app->session->set('previousJobFieldSearch', $previousJobFieldSearch);
            Yii::$app->session->set('workingExperienceSearch', $workingExperienceSearch);

            $winnerId = null;
            $winnerModel = null;
            $highestScore = 0;
            foreach ($userProfileModel as $userProfile) {
                $score = 0;
                if ($userProfile->qualification == $qualificationSearch && $qualificationSearch != '')
                    $score++;
                if ($userProfile->previous_job_field == $previousJobFieldSearch && $previousJobFieldSearch != '')
                    $score++;
                if ($userProfile->working_experience == $workingExperienceSearch && $workingExperienceSearch != '')
                    $score++;

                if ($userProfile->skills != '' || $userProfile->skills != null) {
                    $arr1 = explode(',', $userProfile->skills);
                    $arr2 = explode(',', $skillsSearch);
                    $intersect = array_intersect($arr1, $arr2);
                    $score = $score + count($intersect);
                }

                if ($userProfile->language != '' || $userProfile->language != null) {
                    $arr1 = explode(',', $userProfile->language);
                    $arr2 = explode(',', $languageSearch);
                    $intersect = array_intersect($arr1, $arr2);
                    $score = $score + count($intersect);
                }

                if ($userProfile->leadership_experience != '' || $userProfile->leadership_experience != null) {
                    $arr1 = explode(',', $userProfile->leadership_experience);
                    $arr2 = explode(',', $leadershipExpSearch);
                    $intersect = array_intersect($arr1, $arr2);
                    $score = $score + count($intersect);
                }

                if ($score > $highestScore) {
                    $highestScore = $score;
                    $winnerId = $userProfile->id;
                }
            }

            $provider = new \yii\data\ActiveDataProvider([
                'query' => \common\models\UserProfile::find()
                        ->innerJoin('auth_assignment a', 'a.user_id = user_profile.user_id')
                        ->where('a.item_name="employee"'),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);

            $readAttachment = null;
            if ($winnerId && $totalSearch != 0) {
                $winnerModel = \common\models\UserProfile::find()->where(['id' => $winnerId])->one();
                if ($winnerModel->profile_pic_id != 0) {
                    $readAttachment = \common\models\DocAttach::findOne($winnerModel->profile_pic_id);
                }
            }

            return $this->render('talent', [
                        'provider' => $provider,
                        'winnerModel' => $winnerModel,
                        'highestScore' => $highestScore,
                        'readAttachment' => $readAttachment,
            ]);
        } else {
            return $this->render('search', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

}
