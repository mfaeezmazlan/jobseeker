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
                <?= Html::a(Yii::t('app', 'Update <i class="fa fa-pencil"></i>'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']);
                ?>
                <?=
                Html::a(Yii::t('app', 'Delete <i class="fa fa-trash"></i>'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ])
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
                                'value' => function($model) {
                                    $skillsRequire = explode(',', $model->skills_require);
                                    $myskills = explode(',', common\models\UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one()->skills);
                                    $diff = array_diff($myskills, $skillsRequire);

                                    $totalSkillsRequire = count($skillsRequire);

                                    return (count($skillsRequire) - 1) / count($skillsRequire) * 100 . "%";
                                }
                                    ],
                                ],
                            ]);
                            ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->