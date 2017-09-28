<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
$this->title = $model->first_name;
$this->params['breadcrumbs'][] = 'My Profile';
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Make your profile awesome!!
        </small>
        <?= Html::a('<i class="fa fa-pencil green icon-animated-vertical"></i>', ['user-profile/update'], ['class' => 'pull-right']) ?>
    </h1>
</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div>
            <div id="user-profile-1" class="user-profile row">
                <div class="col-xs-12 col-sm-3 center">
                    <div>
                        <!-- #section:pages/profile.picture -->
                        <span class="profile-picture">
                            <img id="avatar" class="editable img-responsive" height="200px" alt="Alex's Avatar" src="<?= Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['unknownUserImagePath'] ?>" />
                        </span>

                        <!-- /section:pages/profile.picture -->
                        <div class="space-4"></div>

                        <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                            <div class="inline position-relative">
                                <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                    <i class="ace-icon fa fa-circle light-green"></i>
                                    &nbsp;
                                    <span class="white"><?= $model->first_name . " " . $model->last_name ?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="space-6"></div>

                    <!-- #section:pages/profile.contact -->

                    <!-- /section:pages/profile.contact -->
                    <div class="hr hr12 dotted"></div>

                    <!-- #section:custom/extra.grid -->
                    <div class="clearfix">
                        <div class="grid2">
                            <span class="bigger-175 blue"><?= count(\common\models\JobApplication::find()->where(['user_id' => Yii::$app->user->identity->id])->all()) ?></span>

                            <br />
                            Submission
                        </div>

                        <div class="grid2">
                            <span class="bigger-175 green"><?= count(\common\models\JobApplication::find()->where(['user_id' => Yii::$app->user->identity->id, 'status' => 2])->all()) ?></span>

                            <br />
                            Approval
                        </div>
                    </div>

                    <!-- /section:custom/extra.grid -->
                    <div class="hr hr16 dotted"></div>
                </div>

                <div class="col-xs-12 col-sm-9">

                    <div class="space-12"></div>

                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="widget-title smaller">Biodata</h5>
                            <!-- #section:custom/widget-box.tabbed -->
                            <div class="widget-toolbar no-border">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active">
                                        <a data-toggle="tab" href="#home">General Information</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#profile">Home Address</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#info">Info</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /section:custom/widget-box.tabbed -->
                        </div>
                        <div class="widget-body">
                            <div class="widget-main padding-6">
                                <div class="tab-content">
                                    <div id="home" class="tab-pane in active">

                                        <!-- #section:pages/profile.info -->
                                        <div class="profile-user-info profile-user-info-striped">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Full name </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="username"><?= $model->first_name . " " . $model->last_name ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Address </div>
                                                <div class="profile-info-value">
                                                    <?= $model->address->fullAddress ?>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Mobile No </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="mobile_no"><?= $model->mobile_no ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Home No </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="home_no"><?= $model->home_no ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Skills </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="about"><?= $model->skills ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> About Me </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="about"><?= $model->description ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Resume </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="about">
                                                        <?php
                                                            // echo \common\components\FileHandler::generateDocument($model, Yii::getAlias('@web') . "/uploads/resume/" . Yii::$app->user->id); 
                                                            $user_doc = common\models\UserDoc::find()->where(['user_id' => $model->user_id])->orderBy(['id' => SORT_DESC])->one();
                                                            echo Html::a($user_doc->docAttach->file_name, ['user-profile/download-attachment', 'id' => $user_doc->doc_attach_id, 'user_id' => $model->user_id])
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="profile" class="tab-pane">
                                        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
                                    </div>
                                    <div id="info" class="tab-pane">
                                        <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->