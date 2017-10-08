<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\UserProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>





<div class="col-xs-12 col-sm-12 pricing-box" id="talent_div">
    <div class="widget-box widget-color-blue">
        <div class="widget-header">
            <h5 class="widget-title bigger">Talent Search</h5>
        </div>
        <div class="widget-body">
            <?php
            $form = ActiveForm::begin([
                        'action' => ['search'],
                        'method' => 'get',
//                        'options' => ['data-pjax' => true]
            ]);
            ?>
            <div class="widget-main">
                <div class="talent-profile-search" >
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
                    echo $form->field($model, 'language')->widget(Select2::className(), [
                        'showToggleAll' => false,
                        'data' => common\models\Reference::getList('language'),
                        'options' => [
                            'placeholder' => 'Select Language',
                            'value' => explode(',', $model->language)
                        ],
                        'pluginOptions' => [
                            'multiple' => true,
                            'maximumSelectionLength' => 5,
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
                    <?= $form->field($model, 'min_salary')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'max_salary')->textInput(['maxlength' => true]) ?>
                    <div class="form-group">
                    </div>
                </div>
            </div>
            <div>
                <?= Html::submitButton(Yii::t('app', 'Search <i class="fa fa-search"></i>'), ['class' => 'btn btn-block btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>