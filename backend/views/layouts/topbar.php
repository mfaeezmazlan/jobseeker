
<?php

use yii\helpers\Html;

$assignmentRole = \common\models\AuthAssignment::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
$modelUserProfile = \common\models\UserProfile::find()->where(['user_id' => Yii::$app->user->id])->one();
$pathToProfilePic = Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['unknownUserImagePath'];
if ($modelUserProfile->profile_pic_id != 0) {
    $readAttachment = \common\models\DocAttach::findOne($modelUserProfile->profile_pic_id);
    $pathToProfilePic = Yii::getAlias('@web') . '/uploads/resume/' . Yii::$app->user->id . '/' . $readAttachment->file_name_sys;
}

$listOfUnreadNotification = \common\models\Notification::find()
        ->where(['to' => Yii::$app->user->id, 'status' => '0'])
        ->limit(5)
        ->orderBy(['created_at' => SORT_DESC])->all();
?>
<div id="navbar" class="navbar navbar-default">                    
    <script type="text/javascript">
        try {
            ace.settings.check('navbar', 'fixed')
        } catch (e) {
        }
    </script>
    <div class="navbar-container" id="navbar-container">
        <!-- #section:basics/sidebar.mobile.toggle -->
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- /section:basics/sidebar.mobile.toggle -->
        <div class="navbar-header pull-left">
            <!-- #section:basics/navbar.layout.brand -->
            <a href="#" class="navbar-brand">
                <small>
                    <i class="fa fa-copyright"></i>
                    AMH Reality Enterprise
                </small>
            </a>
            <!-- /section:basics/navbar.layout.brand -->
            <!-- #section:basics/navbar.toggle -->
            <!-- /section:basics/navbar.toggle -->
        </div>
        <!-- #section:basics/navbar.dropdown -->
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="green">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                        <span class="badge badge-success"><?= count($listOfUnreadNotification) ?></span>
                    </a>
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-envelope-o"></i>
                            <?= count($listOfUnreadNotification) ?> Unread Messages
                        </li>
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                <?php
                                foreach ($listOfUnreadNotification as $notification) {
                                    $notificationUserModel = \backend\models\User::findOne($notification->from);
                                    
                                    ?>
                                    <li>
                                        <a id="notificationid_<?= $notification->id ?>" href="index.php?r=<?= $notification->path ?>" class="clearfix">
                                            <img src="<?= (($notificationUserModel->userProfile->profile_pic_id == 0) ? Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['unknownUserImagePath'] : common\models\DocAttach::getNotificationImage($notificationUserModel->userProfile->profile_pic_id, Yii::getAlias('@web') . '/uploads/resume/'.$notificationUserModel->id)) ?>" class="msg-photo" alt="Ahmad's Avatar" />
                                            <span class="msg-body">
                                                <span class="msg-title">
                                                    <span class="blue"><?= $notificationUserModel->userProfile->first_name ?>:</span>
                                                    <?= $notification->message ?>
                                                </span>
                                                <span class="msg-time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span><?= \common\components\DateHandler::resolveDateRead($notification->created_at) ?></span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="dropdown-footer">
                            <a href="index.php?r=notification/index">
                                See all messages
                                <i class="ace-icon fa fa-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- #section:basics/navbar.user_menu -->
                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="<?= $pathToProfilePic ?>" alt="user photo" />
                        <span class="user-info">
                            <small>Welcome,</small><?= Yii::$app->user->identity->userProfile->first_name ?>
                        </span>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <?php
                        if ($assignmentRole->item_name != 'admin'):
                            ?>
                            <li>
                                <?= Html::a("<i class='ace-icon fa fa-user'></i> Profile", ['user-profile/my-profile']) ?>

                            </li>
                            <li class="divider"></li>
                                <?php
                            endif;
                            ?>
                        <li>
                            <?= yii\helpers\Html::a('<i class="ace-icon fa fa-power-off"></i>Logout', ['site/logout']) ?>
                        </li>
                    </ul>
                </li>
                <!-- /section:basics/navbar.user_menu -->
            </ul>
        </div>
        <!-- /section:basics/navbar.dropdown -->
    </div><!-- /.navbar-container -->
</div>
<?php
$this->registerJs("
    $('document').ready(function(){ 
        $('a[id^=notificationid_]').click(function(){
            var notificationid = this.id;
            var notificationid = notificationid.substring(notificationid.indexOf('_') + 1);
            
            $.get('index.php?r=notification/read',{id:notificationid});
        });
    });
", \yii\web\View::POS_END);
?>