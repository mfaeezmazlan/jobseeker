<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobList */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Job List',
]) . $model->field;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->field, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="job-list-update">

    <h1><?= Html::encode($this->field) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
