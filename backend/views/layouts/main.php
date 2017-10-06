<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
//use common\widgets\Alert;

AppAsset::register($this);
?>

<?php

function setflash($messageGiven, $messageType) {
    ?>
    <div id="xalert" class="alert alert-<?= $messageType ?>">
        <button class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <?= $messageGiven ?>
    </div>
    <?php
    unset(Yii::$app->session['flash_msg']);
    unset(Yii::$app->session['flash_type']);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <!--<script src="../../../web/_theme/assets/js/ace-extra.js"></script>-->
    </head>
    <?php
    if (!Yii::$app->user->isGuest) {
        ?>
        <body class="no-skin">
            <?php
        } else {
            ?>
        <body class="login-layout light-login">
            <?php
        }
        ?>
        <?php $this->beginBody() ?>
        <script>
            setTimeout(function () {
                $('#xalert').hide('slow');
            }, 5000);
        </script>
        <?php
        if (!Yii::$app->user->isGuest) {
            ?>
            <?php include('topbar.php') ?>

            <div class="main-container" id="main-container">
                <script type="text/javascript">
                    try {
                        ace.settings.check('main-container', 'fixed')
                    } catch (e) {
                    }
                </script>
                <!-- #section:basics/sidebar -->
                <?php include('sidebar.php'); ?>
                <!-- /section:basics/sidebar -->
                <div class="main-content">
                    <div class="main-content-inner">
                        <!-- #section:basics/content.breadcrumbs -->
                        <?php include('breadcrumbs.php'); ?>
                        <!-- /section:basics/content.breadcrumbs -->
                        <div class="page-content">

                            <?php
                            $session_flash_message = Yii::$app->session['flash_msg'];
                            $session_flash_type = Yii::$app->session['flash_type'];
                            if ($session_flash_message && $session_flash_type) {
                                setflash($session_flash_message, $session_flash_type);
                            }
                            ?>
                            <?= $content ?>
                        </div><!-- /.page-content -->
                    </div>
                </div><!-- /.main-content -->
                <div class="footer">
                    <div class="footer-inner">
                        <!-- #section:basics/footer -->
                        <div class="footer-content">
                            <span class="bigger-120">
                                <span class="blue bolder">AMH Reality Enterprise</span>
                                &copy; <?= date('Y') ?>
                            </span>
                        </div>
                        <!-- /section:basics/footer -->
                    </div>
                </div>
                <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
                </a>
            </div><!-- /.main-container -->
            <?php
        } else {
            ?>
            <div class="main-container">
                <div class="main-content">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="login-container">
                                <?php
                                $session_flash_message = Yii::$app->session['flash_msg'];
                                $session_flash_type = Yii::$app->session['flash_type'];
                                if ($session_flash_message && $session_flash_type) {
                                    setflash($session_flash_message, $session_flash_type);
                                }
                                echo $content;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
