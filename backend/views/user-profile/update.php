<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */

$this->title = Yii::t('app', 'Update My Profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Profile'), 'url' => ['user-profile/my-profile']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Give some flavour
        </small>
    </h1>
</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <div class="user-update">
            <?=
            $this->render('_form', [
                'model' => $model,
                'modelAddress' => $modelAddress,
                'modelAttachment' => $modelAttachment,
                'readAttachment' => $readAttachment,
            ])
            ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->