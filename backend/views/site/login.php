<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="center">
    <h1>
        <i class="ace-icon fa fa-laptop green"></i>
        <span class="red">Job</span>
        <span class="white" id="id-text2">Seeker</span>
    </h1>
    <h4 class="blue" id="id-company-text">&copy; AMH Reality Enterprise</h4>
</div>
<div class="space-6"></div>
<div class="position-relative">
    <div id="login-box" class="login-box visible widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header blue lighter bigger">
                    <i class="ace-icon fa fa-info-circle green"></i>
                    Please Enter Your Information
                </h4>
                <div class="space-6"></div>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <fieldset>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username'])->label(false) ?>
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </label>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
                            <i class="ace-icon fa fa-lock"></i>
                        </span>
                    </label>

                    <div class="space"></div>

                    <div class="clearfix">
                        <?= $form->field($model, 'rememberMe', ['checkboxTemplate' => '<label class="inline">{input}<span class="lbl">{label}</span></label><button type="submit" class="width-35 pull-right btn btn-sm btn-primary"><i class="ace-icon fa fa-key"></i><span class="bigger-110">Login</span></button>'])->checkbox(['class' => 'ace']) ?>
                    </div>
                    <div class="space-4"></div>
                </fieldset>
                <?php ActiveForm::end(); ?>
            </div><!-- /.widget-main -->

            <div class="toolbar clearfix">
                <div>
                    <a href="#" data-target="#forgot-box" class="forgot-password-link">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        I forgot my password
                    </a>
                </div>

                <div>
                    <a href="#" data-target="#signup-box" class="user-signup-link">
                        I want to register
                        <i class="ace-icon fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div><!-- /.widget-body -->
    </div><!-- /.login-box -->
    <div id="forgot-box" class="forgot-box widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header red lighter bigger">
                    <i class="ace-icon fa fa-key"></i>
                    Retrieve Password
                </h4>
                <div class="space-6"></div>
                <p>
                    Enter your email and to receive instructions
                </p>
                <?php $formRequestPassword = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <fieldset>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <?= $formRequestPassword->field($modelPasswordResetRequest, 'email')->textInput(['autofocus' => true])->label(false) ?>
                            <i class="ace-icon fa fa-envelope"></i>
                        </span>
                    </label>
                    <div class="clearfix">
                        <?= Html::submitButton('<i class="ace-icon fa fa-lightbulb-o"></i><span class="bigger-110">Send Me!</span>', ['class' => 'width-35 pull-right btn btn-sm btn-danger']) ?>
                    </div>
                </fieldset>
                <?php ActiveForm::end(); ?>
            </div><!-- /.widget-main -->
            <div class="toolbar center">
                <a href="#" data-target="#login-box" class="back-to-login-link">
                    Back to login
                    <i class="ace-icon fa fa-arrow-right"></i>
                </a>
            </div>
        </div><!-- /.widget-body -->
    </div><!-- /.forgot-box -->
    <div id="signup-box" class="signup-box widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header green lighter bigger">
                    <i class="ace-icon fa fa-users blue"></i>
                    New User Registration
                </h4>
                <div class="space-6"></div>
                <p> Enter your details to begin: </p>
                <?php $formRegistration = ActiveForm::begin(['id' => 'registration-form']); ?>
                <fieldset>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <?= $formRegistration->field($modelUser, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Email'])->label(false) ?>
                            <i class="ace-icon fa fa-envelope"></i>
                        </span>
                    </label>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <?= $formRegistration->field($modelUser, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username'])->label(false) ?>
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </label>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <?= $formRegistration->field($modelUser, 'password')->passwordInput(['autofocus' => true, 'placeholder' => 'Password'])->label(false) ?>
                            <i class="ace-icon fa fa-lock"></i>
                        </span>
                    </label>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <?= $formRegistration->field($modelUser, 'repeat_password')->passwordInput(['autofocus' => true, 'placeholder' => 'Repeat Password'])->label(false) ?>
                            <i class="ace-icon fa fa-retweet"></i>
                        </span>
                    </label>
                    <div class="space-24"></div>
                    <div class="clearfix">
                        <button type="reset" class="width-30 pull-left btn btn-sm">
                            <i class="ace-icon fa fa-refresh"></i>
                            <span class="bigger-110">Reset</span>
                        </button>
                        <button type="save" class="width-65 pull-right btn btn-sm btn-success">
                            <span class="bigger-110">Register</span>
                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                        </button>
                    </div>
                </fieldset>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="toolbar center">
                <a href="#" data-target="#login-box" class="back-to-login-link">
                    <i class="ace-icon fa fa-arrow-left"></i>
                    Back to login
                </a>
            </div>
        </div><!-- /.widget-body -->
    </div><!-- /.signup-box -->
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
    jQuery(function ($) {
        $('#btn-login-dark').on('click', function (e) {
            $('body').attr('class', 'login-layout');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'blue');
            e.preventDefault();
        });
        $('#btn-login-light').on('click', function (e) {
            $('body').attr('class', 'login-layout light-login');
            $('#id-text2').attr('class', 'grey');
            $('#id-company-text').attr('class', 'blue');
            e.preventDefault();
        });
        $('#btn-login-blur').on('click', function (e) {
            $('body').attr('class', 'login-layout blur-login');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'light-blue');
            e.preventDefault();
        });
    });
});
", \yii\web\View::POS_END);
?>
