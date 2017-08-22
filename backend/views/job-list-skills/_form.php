<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\JobListSkills */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-list-skills-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'job_list_id')->textInput() ?>

    <?= $form->field($model, 'skills_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
