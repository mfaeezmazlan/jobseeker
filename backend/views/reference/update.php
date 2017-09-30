<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reference */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
            'modelClass' => 'Reference',
        ]) . $model->cat;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'References'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Update current references
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <div class="reference-update">
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -