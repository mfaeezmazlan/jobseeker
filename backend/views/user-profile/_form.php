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
                            <a data-toggle="tab" href="#education">Education <i class="fa fa-graduation-cap red"></i></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#experience">Experience <i class="fa fa-briefcase dark"></i></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#about_me">About me! <i class="fa fa-file purple"></i></a>
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
                        <div id="home_address" class="tab-pane">
                            <div class="container">
                                <p>Share us your contact information so that we can easily communicate with you</p>
                                <div class="hr hr8 hr-double hr-dotted"></div>
                                <?= $form->field($modelAddress, 'street_1')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelAddress, 'street_2')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelAddress, 'postcode')->textInput(['maxlength' => true]) ?>
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
                                <?= $form->field($modelAddress, 'district')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($modelAddress, 'city')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div id="education" class="tab-pane">
                            <div class="container">
                                <p>Please select the highest education level that you have been studied</p>
                                <div class="hr hr8 hr-double hr-dotted"></div>
                                <?= $form->field($model, 'qualification')->dropDownList(\common\models\Reference::getList('qualification'), ['prompt' => '-- Please Select --']) ?>
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
                                        'maximumSelectionLength' => 15,
                                        'allowClear' => true,
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                        <div id="experience" class="tab-pane">
                            <div class="container">
                                <p>Tell us your qualities and experience</p>
                                <div class="hr hr8 hr-double hr-dotted"></div>
                                <?php
                                echo $form->field($model, 'leadership_experience')->widget(Select2::className(), [
                                    'showToggleAll' => false,
                                    'data' => common\models\Reference::getList('leadership_exp'),
                                    'options' => [
                                        'placeholder' => 'Select Leadership Experience',
                                        'value' => ($model->isNewRecord ? null : explode(',', $model->leadership_experience))
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
                            </div>
                        </div>
                        <div id="about_me" class="tab-pane">
                            <div class="container">
                                <p>Last but not least, of course about yourself. Do tell us.</p>
                                <div class="hr hr8 hr-double hr-dotted"></div>
                                <?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'home_no')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => '5']) ?>
                                <?php
                                if ($readAttachment)
                                    echo $form->field($modelAttachment, 'file', ['template' => '{label}{input} Current File: <font color="#478fca">' . Html::a($readAttachment->file_name, ['user-profile/download-attachment', 'id' => $readAttachment->id, 'user_id' => $model->user_id]) . '</font>'])->fileInput();
                                else
                                    echo $form->field($modelAttachment, 'file')->fileInput();
                                ?>
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