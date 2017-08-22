<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Profile',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
