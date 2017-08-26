<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
            'modelClass' => 'User',
        ]) . $model->userProfile->first_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->userProfile->first_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <div class="user-update">
            <?=
            $this->render('_form', [
                'model' => $model,
                'modelUserProfile' => $modelUserProfile,
                'modelAddress' => $modelAddress,
            ])
            ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->