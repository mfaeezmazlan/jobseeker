<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <div class="user-create">


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