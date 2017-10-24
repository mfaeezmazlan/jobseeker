<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\JobList */

$this->title = common\models\Reference::getDesc('job_field', $model->field) . ": " . $model->position;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Application'), 'url' => ['application']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <div class="job-application-view">
            <p>
                <?php
                if ($tmpModelJobApplicationList = \common\models\JobApplication::find()->where(['user_id' => Yii::$app->user->identity->id, 'job_list_id' => $model->id])->one()){
                    switch ($tmpModelJobApplicationList->status){
                        case 0:
                            echo "<i class='fa fa-check blue'></i> You have applied for this job. Please wait for further action of our staff.";
                            break;
                        case 1:
                            echo "<i class='fa fa-times red'></i> We are sorry as your qualification did not meet our expectation.";
                            break;
                        case 2:
                            echo "<i class='fa fa-check-circle-o green'></i> Congratulations!! You have been selected to join us.";
                            break;
                        case 3:
                            echo "<i class='fa fa-check-circle green'></i> Congratulations!! You have been offered to join us directly because of your talent.";
                            break;
                    }
                }
                else{
                    echo Html::a(Yii::t('app', 'Apply <i class="fa fa-check"></i>'), ['apply', 'id' => $model->id], ['class' => 'btn btn-success btn-sm']);
                }
                ?>
            </p>

            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'company_id',
                        'value' => function($model) {
                            return $model->company->company_name;
                        }
                    ],
                    [
                        'attribute' => 'field',
                        'value' => function($model) {
                            return common\models\Reference::getDesc('job_field', $model->field);
                        }
                    ],
                    'position',
                    'salary',
                    'description',
                    [
                        'attribute' => 'skills_require',
                        'format' => 'raw',
                        'value' => function($model) {
                            $arr = array();
                            $skills = explode(',', $model->skills_require);
                            foreach ($skills as $x) {
                                $arr[] = common\models\Reference::getDesc('skills', $x);
                            }
                            return implode(', ', $arr);
                        }
                    ],
                    [
                        'attribute' => 'skill_match',
                        'header' => 'Skills Match',
                        'format' => 'raw',
                        'value' => function($model) {
                            $skillsRequire = explode(',', $model->skills_require);
                            $myskills = explode(',', common\models\UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one()->skills);
                            $intersect = array_intersect($myskills, $skillsRequire);

                            $totalSkillsRequire = count($skillsRequire);

                            return (count($intersect) / count($skillsRequire)) * 100 . "%";
                        }
                    ],
                ],
            ]);
            ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->