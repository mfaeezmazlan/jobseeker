<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($modelUserProfile, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelUserProfile, 'last_name')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($modelAddress, 'country')->widget(Select2::className(), [
        'initValueText' => ($modelAddress->isNewRecord ? null : common\models\Countries::findOne($modelAddress->country)->name),
        'options' => [
            'placeholder' => 'Select Country'
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'ajax' => [
                'url' => Url::to(['/site/get-country']),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {search:params.term, exclude:"super"}; }'),
            ]
        ]
    ])
    ?>

    <?= $form->field($modelAddress, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelAddress, 'district')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelAddress, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelAddress, 'street_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelAddress, 'street_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelAddress, 'postcode')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>