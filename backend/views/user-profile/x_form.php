<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
$counter = 0;
?>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="row">
    <h4>Personal Information <i class="fa fa-user blue"></i></h4>
    <div class="col-xs-12 col-md-3 col-lg-3">
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-3 col-lg-3">
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-3 col-lg-3">
        <?= $form->field($model, 'nric')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-3 col-lg-3">
        <?= $form->field($model, 'gender')->dropDownList(\common\models\Reference::getList('gender'), ['prompt' => '-- Please Select --']) ?>
    </div>

    <div class="col-xs-12 col-md-4 col-lg-4">
        <?= $form->field($model, 'date_of_birth')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-4 col-lg-4">
        <?= $form->field($model, 'marital_status')->dropDownList(\common\models\Reference::getList('marital_status'), ['prompt' => '-- Please Select --']) ?>
    </div>

    <div class="col-xs-12 col-md-4 col-lg-4">        
        <?=
        $form->field($model, 'language')->widget(Select2::className(), [
            'showToggleAll' => false,
            'data' => common\models\Reference::getList('language'),
            'options' => [
                'placeholder' => 'Select languages',
                'value' => ($model->isNewRecord ? null : explode(',', $model->language))
            ],
            'pluginOptions' => [
                'multiple' => true,
                'maximumSelectionLength' => 5,
                'allowClear' => true,
            ],
        ]);
        ?>
    </div>
</div>
<div class="hr hr8 hr-double hr-dotted"></div>
<div class="row">
    <h4>Home Address <i class="fa fa-map-marker blue"></i></h4>
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
<div class="hr hr8 hr-double hr-dotted"></div>
<div class="row">
    <h4>Education <i class="fa fa-graduation-cap blue"></i></h4>
</div>
<div class="hr hr8 hr-double hr-dotted"></div>
<div class="row">
    <h4>Experience <i class="fa fa-suitcase blue"></i></h4>
</div>
<div class="hr hr8 hr-double hr-dotted"></div>
<div class="row">
    <h4>Simple CV <i class="fa fa-file blue"></i></h4>
    <div class="col-xs-12 col-md-8 col-lg-8">
        <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => '5']) ?>
    </div>
    <div class="col-xs-12 col-md-4 col-lg-4" id="panelAddFrame">
        <?=
        $form->field($model, 'skills')->widget(Select2::className(), [
            'showToggleAll' => false,
            'data' => common\models\Reference::getList('skills'),
            'options' => [
                'placeholder' => 'Select skills',
                'value' => ($model->isNewRecord ? null : explode(',', $model->skills))
            ],
            'pluginOptions' => [
                'multiple' => true,
                'maximumSelectionLength' => 5,
                'allowClear' => true,
            ],
        ]);
        ?>
    </div>
    <div class="col-xs-12 col-md-12 col-lg-12">

        <?php
        if ($fileName)
            echo $form->field($modelAttachment, 'file', ['template' => '{label}{input} Current File: <font color="#478fca">' . $fileName . '</font>'])->fileInput();
        else
            echo $form->field($modelAttachment, 'file')->fileInput();
        ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-12 col-md-3 col-lg-3">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php
$this->registerJs("
    function delAdditionalPanel(id){
        $('#additionalPanel_'+id).remove();
    }
    
    $(document).ready(function() {
        var baseUrl = 'index.php?r=user-profile/display-skills';
        var counter = $('div[id^=additionalPanel_]').length + 1;
        
        $('#btnAddPanel').click(function(){
            $.get(baseUrl,{counter: counter},function(data){
                $('#panelAddFrame').append(data);
            });
            counter++;
        });        
    });
", \yii\web\View::POS_END);
?>