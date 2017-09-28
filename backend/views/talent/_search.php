<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\UserProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'qualification')->dropDownList(\common\models\Reference::getList('qualification'), ['prompt' => '-- Please Select --']) ?>
    <?=
    $form->field($model, 'skills')->widget(Select2::className(), [
        'showToggleAll' => false,
        'data' => common\models\Reference::getList('skills'),
        'options' => [
            'placeholder' => 'Select skills',
            'value' => explode(',', $model->skills)
        ],
        'pluginOptions' => [
            'multiple' => true,
            'maximumSelectionLength' => 15,
            'allowClear' => true,
        ],
    ]);
    ?>

    <?php
    echo $form->field($model, 'leadership_experience')->widget(Select2::className(), [
        'showToggleAll' => false,
        'data' => common\models\Reference::getList('leadership_exp'),
        'options' => [
            'placeholder' => 'Select Leadership Experience',
            'value' => explode(',', $model->leadership_experience)
        ],
        'pluginOptions' => [
            'multiple' => true,
            'maximumSelectionLength' => 5,
            'allowClear' => true,
        ],
    ]);
    ?>
    <?php
    echo $form->field($model, 'previous_job_field')->widget(Select2::className(), [
        'showToggleAll' => false,
        'data' => common\models\Reference::getList('job_field'),
        'options' => [
            'placeholder' => 'Select Job Field',
        ],
        'pluginOptions' => [
            'multiple' => false,
            'allowClear' => true,
        ],
    ]);
    ?>
    <?= $form->field($model, 'working_experience')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'expected_salary')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a(Yii::t('app', 'Reset'),['talent/index'], ['class' => 'btn btn-default btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
