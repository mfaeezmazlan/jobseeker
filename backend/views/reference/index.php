<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'References');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            System References
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <div class="reference-index">
            <p>
                <?= Html::a(Yii::t('app', 'Create Reference <i class="fa fa-plus"></i>'), ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
            </p>
            <?php Pjax::begin(); ?>    
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'cat',
                    'code',
                    'descr',
                    'param1',
                    ['class' => 'yii\grid\ActionColumn', 'headerOptions' => ['style' => 'width:75px'], 'header' => 'Action'],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->