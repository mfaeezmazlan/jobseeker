<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JobListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Job Application');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Find the job you love
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <div class="job-application">
            <?php Pjax::begin(); ?>    
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'company_id',
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'company_id',
                            'data' => \common\models\CompanyProfile::getList(),
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => [
                                'placeholder' => 'Select All',
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ]
                        ]),
                        'value' => function($model) {
                            return $model->company->company_name;
                        }
                    ],
                    [
                        'attribute' => 'field',
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'field',
                            'data' => \common\models\Reference::getList('job_field'),
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => [
                                'placeholder' => 'Select All',
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ]
                        ]),
                        'value' => function($model) {
                            return common\models\Reference::getDesc('job_field', $model->field);
                        }
                    ],
                    'position',
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
                        'attribute' => 'status_application',
                        'header' => 'Application Status',
                        'format' => 'raw',
                        'value' => function($model) {
                            $data = \common\models\JobApplication::find()->where(['user_id' => Yii::$app->user->identity->id, 'job_list_id' => $model->id])->one();
                            if ($data)
                                return common\models\Reference::getDesc('status_application', $data->status);
                            else
                                return null;
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width:75px'],
                        'template' => '{view_application}',
                        'buttons' => [
                            'view_application' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye blue"></i>', ['job-list/view-application', 'id' => $model->id]);
                            },
                        ]
                    ],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->