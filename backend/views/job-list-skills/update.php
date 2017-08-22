<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobListSkills */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Job List Skills',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job List Skills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="job-list-skills-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
