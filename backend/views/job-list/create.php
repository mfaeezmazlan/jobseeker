<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobList */

$this->title = Yii::t('app', 'Create Job List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'modelJobSkills' => $modelJobSkills
    ])
    ?>

</div>
