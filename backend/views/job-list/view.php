<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\JobList */

$this->title = $model->field;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Lists'), 'url' => ['index']];
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
                if (\common\models\JobApplication::find()->where(['user_id' => Yii::$app->user->identity->id, 'job_list_id' => $model->id])->one())
                    echo "<i class='fa fa-check green'></i> You have applied for this job.";
                else
                    echo Html::a(Yii::t('app', 'Apply <i class="fa fa-check"></i>'), ['apply', 'id' => $model->id], ['class' => 'btn btn-success btn-sm']);
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
                    'field',
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
                        'attribute' => 'success_chance',
                        'header' => 'Success Chance',
                        'format' => 'raw',
                        'value' => function($model){
                            $skillsRequire = explode(',', $model->skills_require);
                            $myskills = explode(',',common\models\UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one()->skills);
                            $diff = array_diff($myskills, $skillsRequire);
                            
                            $totalSkillsRequire = count($skillsRequire);
                            
                            return (count($skillsRequire)-1)/count($skillsRequire)*100 . "%";
                        }
                    ],
                ],
            ]);
                    ?>

        </div>

    </div><!-- /.col -->
</div><!-- /.row -->