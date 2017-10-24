<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JobListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Job Application');
$this->params['breadcrumbs'][] = $this->title;

$source = \common\models\JobList::find()->where(['isDeleted' => '0'])->orderBy(['position' => SORT_ASC])->all();
$options['job_list'] = \yii\helpers\ArrayHelper::map($source, 'id', 'position');
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Offering Job Application to <?= \backend\models\User::findOne($jobApplicationModel->user_id)->userProfile->first_name ?>
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <div class="offer-application">
            <?php $form = ActiveForm::begin(['fieldConfig' => ['template' => "{label}\n{input}"]]); ?>
            
            <?=
            $form->field($jobApplicationModel, 'job_list_id')->widget(Select2::className(), [
                'showToggleAll' => false,
                'data' => $options['job_list'],
                'options' => [
                    'placeholder' => 'Select Job to Offer',
                ],
                'pluginOptions' => [
                    'multiple' => false,
                    'allowClear' => true,
                ],
            ]);
            ?> 
            <?= Html::submitButton($jobApplicationModel->isNewRecord ? Yii::t('app', 'Offer this job to ') . \backend\models\User::findOne($jobApplicationModel->user_id)->userProfile->first_name : Yii::t('app', 'Update'), ['class' => $jobApplicationModel->isNewRecord ? 'btn btn-success btn-sm btn-block' : 'btn btn-primary btn-sm btn-block']) ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->