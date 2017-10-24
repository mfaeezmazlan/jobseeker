<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JobListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Job Lists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            My Job List Offer
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <div class="job-list-index">
            <?= Html::a(Yii::t('app', 'Create <i class="fa fa-plus"></i>'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
            <?php Pjax::begin(); ?>    <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
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
                        'attribute' => 'Accepted Application',
                        'headerOptions' => ['style' => 'width:150px'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'value' => function($model) {
                            return count(common\models\JobApplication::find()->where(['job_list_id' => $model->id, 'status' => 2])->all());
                        }
                    ],
                    [
                        'attribute' => 'Rejected Application',
                        'headerOptions' => ['style' => 'width:150px'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'value' => function($model) {
                            return count(common\models\JobApplication::find()->where(['job_list_id' => $model->id, 'status' => 1])->all());
                        }
                    ],
                    [
                        'attribute' => 'Pending Application',
                        'headerOptions' => ['style' => 'width:150px'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'value' => function($model) {
                            return count(common\models\JobApplication::find()->where(['job_list_id' => $model->id, 'status' => 0])->all());
                        }
                    ],
                    [
                        'attribute' => 'Total Application',
                        'headerOptions' => ['style' => 'width:150px'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'value' => function($model) {
                            return count(common\models\JobApplication::find()->where(['job_list_id' => $model->id])->all());
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn', 'headerOptions' => ['style' => 'width:75px'], 'header' => 'Action'],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->