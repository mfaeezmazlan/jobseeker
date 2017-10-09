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


<?php $form = ActiveForm::begin(['fieldConfig' => ['template' => "{label}\n{input}"]]); ?>
<div class="row">
    <h4>Authentication Info <i class="fa fa-key blue"></i></h4>
    <div class="col-xs-12 col-md-6 col-lg-6">
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-6">
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-6">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-6">
        <?=
        $form->field($modelAuth, 'item_name')->widget(Select2::className(), [
            'options' => [
                'placeholder' => 'Select Role'
            ],
            'data' => common\models\Reference::getList('role'),
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ])
        ?>
    </div>
</div>
<div class="hr hr8 hr-double hr-dotted"></div>
<div class="row">
    <h4>User Profile <i class="fa fa-user blue"></i></h4>
    <div class="col-xs-12 col-md-6 col-lg-6">
        <?= $form->field($modelUserProfile, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-6">
        <?= $form->field($modelUserProfile, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-4 col-lg-4">
        <?= $form->field($modelAddress, 'street_1')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-4 col-lg-4">
        <?= $form->field($modelAddress, 'street_2')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-4 col-lg-4">
        <?= $form->field($modelAddress, 'postcode')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-3 col-lg-3">
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
    </div>

    <div class="col-xs-12 col-md-3 col-lg-3">
        <?=
        $form->field($modelAddress, 'state')->widget(Select2::className(), [
            'initValueText' => ($modelAddress->isNewRecord ? null : common\models\States::getName($modelAddress->state)),
            'options' => [
                'placeholder' => 'Select States'
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'ajax' => [
                    'url' => Url::to(['/site/get-state']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {search:params.term, exclude:"super"}; }'),
                ]
            ]
        ])
        ?>
    </div>

    <div class="col-xs-12 col-md-3 col-lg-3">
        <?= $form->field($modelAddress, 'district')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-3 col-lg-3">
        <?= $form->field($modelAddress, 'city')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
