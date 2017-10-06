<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="center">
    <h1>
        <i class="ace-icon fa fa-leaf green"></i>
        <span class="red">Job</span>
        <span class="white" id="id-text2">Seeker</span>
    </h1>
    <h4 class="blue" id="id-company-text">&copy; AMH Reality Enterprise</h4>
</div>
<div class="space-6"></div>
<div class="position-relative">
    <div id="forgot-box" class="forgot-box visible widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header red lighter bigger">
                    <i class="ace-icon fa fa-key"></i>
                    Retrieve Password
                </h4>
                <div class="space-6"></div>
                <p>
                    Key in your new password
                </p>
                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <fieldset>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label(false) ?>
                            <i class="ace-icon fa fa-envelope"></i>
                        </span>
                    </label>
                    <div class="clearfix">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                    </div>
                </fieldset>
                <?php ActiveForm::end(); ?>
            </div><!-- /.widget-main -->
        </div><!-- /.widget-body -->
    </div><!-- /.forgot-box -->
</div><!-- /.position-relative -->


<?php
$this->registerJs("
$(document).ready(function() {
    jQuery(function ($) {
        $(document).on('click', '.toolbar a[data-target]', function (e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible');//hide others
            $(target).addClass('visible');//show target
        });
    });
});
", \yii\web\View::POS_END);
?>
