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


<?php $form = ActiveForm::begin([ 'options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12">
        <div class="widget-box">
            <div class="widget-header widget-header-small">
                <h5 class="widget-title smaller"><i class="fa fa-pencil"></i> Profile Form</h5>
                <!-- #section:custom/widget-box.tabbed -->
                <div class="widget-toolbar no-border">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                            <a data-toggle="tab" href="#personal_information">Personal Information <i class="fa fa-user green"></i></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#home_address">Home Address <i class="fa fa-map-marker blue"></i></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#company_information">Company Information <i class="fa fa-briefcase dark"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- /section:custom/widget-box.tabbed -->
            </div>
            <div class="widget-body">
                <div class="widget-main padding-6">
                    <div class="tab-content">
                        <div id="personal_information" class="tab-pane in active">
                            <div class="container">
                                <p>Relax, your personal information will not be shared to outside party</p>
                                <div class="hr hr8 hr-double hr-dotted"></div>
                                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'nric')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'gender')->dropDownList(\common\models\Reference::getList('gender'), ['prompt' => '-- Please Select --']) ?>
                                <?= $form->field($model, 'date_of_birth')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'marital_status')->dropDownList(\common\models\Reference::getList('marital_status'), ['prompt' => '-- Please Select --']) ?>
                            </div>
                        </div>
                        <div id="home_address" class="tab-pane">
                            <div class="container">
                                <p>Share us your contact information so that we can easily communicate with you</p>
                                <div class="hr hr8 hr-double hr-dotted"></div>
                                <?= $form->field($modelAddress['user'], '[user]street_1')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelAddress['user'], '[user]street_2')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelAddress['user'], '[user]postcode')->textInput(['maxlength' => true]) ?>
                                <?=
                                $form->field($modelAddress['user'], '[user]country')->widget(Select2::className(), [
                                    'initValueText' => ($modelAddress['user']->isNewRecord ? null : common\models\Countries::findOne($modelAddress['user']->country)->name),
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
                                <?=
                                $form->field($modelAddress['user'], '[user]state')->widget(Select2::className(), [
                                    'initValueText' => ($modelAddress['user']->isNewRecord ? null : common\models\States::getName($modelAddress['user']->state)),
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
                                <?= $form->field($modelAddress['user'], '[user]district')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelAddress['user'], '[user]city')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div id="company_information" class="tab-pane">
                            <div class="container">
                                <p>Changes made will update all staff's company profiles. Make sure you know what are you doing</p>
                                <div class="hr hr8 hr-double hr-dotted"></div>
                                <?= $form->field($modelCompany, 'company_name')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelCompany, 'registration_no')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelCompany, 'mobile_no')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelCompany, 'office_no')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelCompany, 'description')->textInput(['maxlength' => true]) ?>
                                
                                <?= $form->field($modelAddress['company'], '[company]street_1')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelAddress['company'], '[company]street_2')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelAddress['company'], '[company]postcode')->textInput(['maxlength' => true]) ?>
                                <?=
                                $form->field($modelAddress['company'], '[company]country')->widget(Select2::className(), [
                                    'initValueText' => ($modelAddress['company']->isNewRecord ? null : common\models\Countries::findOne($modelAddress['company']->country)->name),
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
                                <?=
                                $form->field($modelAddress['company'], '[company]state')->widget(Select2::className(), [
                                    'initValueText' => ($modelAddress['company']->isNewRecord ? null : common\models\States::getName($modelAddress['company']->state)),
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
                                <?= $form->field($modelAddress['company'], '[company]district')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelAddress['company'], '[company]city')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-12 col-md-12 col-lg-12">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-sm btn-block' : 'btn btn-primary btn-sm btn-block']) ?>
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