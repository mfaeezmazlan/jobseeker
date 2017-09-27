<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\JobList */
/* @var $form yii\widgets\ActiveForm */

$source = common\models\CompanyProfile::find()->where(['isDeleted' => '0'])->orderBy(['company_name' => SORT_ASC])->all();
$option['company_profile'] = ArrayHelper::map($source, 'id', 'company_name');
$assignmentRole = \common\models\AuthAssignment::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
?>

<div class="job-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $form->field($model, 'company_id')->widget(Select2::classname(), [
        'showToggleAll' => true,
        'data' => $option['company_profile'],
        'options' => [
            'placeholder' => '-- Please Select --'
        ],
        'pluginOptions' => [
            'multiple' => false,
            'allowClear' => true,
        ],
    ])
    ?>

    <?= $form->field($model, 'field')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
