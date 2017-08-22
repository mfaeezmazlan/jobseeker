<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\JobListSkills */

$this->title = Yii::t('app', 'Create Job List Skills');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job List Skills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-list-skills-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
