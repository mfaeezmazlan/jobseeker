<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

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
                    'position',
                    [
                        'attribute' => 'field',
                        'value' => function($model) {
                            return common\models\Reference::getDesc('job_field', $model->field);
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
                    ['class' => 'yii\grid\ActionColumn', 'headerOptions' => ['style' => 'width:75px'], 'header' => 'Action'],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->