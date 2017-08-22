<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'address_id')->textInput() ?>

    <?= $form->field($model, 'profile_pic_id')->textInput() ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registration_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
