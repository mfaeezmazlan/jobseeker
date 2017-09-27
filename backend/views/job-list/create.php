<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobList */

$this->title = Yii::t('app', 'Create Job List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Create new job offer
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <div class="job-list-create">
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->