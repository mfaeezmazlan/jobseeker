<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Talent Search');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Searching Talent
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <div class="reference-index">
            <?php Pjax::begin(); ?>  
            <?= $this->render('_search', ['model' => $searchModel]); ?>  
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'first_name',
                    'skills',
                    'leadership_experience',
                    ['class' => 'yii\grid\ActionColumn', 'headerOptions' => ['style' => 'width:75px'], 'header' => 'Action'],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->
