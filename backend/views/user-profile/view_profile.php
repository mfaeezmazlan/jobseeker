<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
$this->title = $model->first_name;
$this->params['breadcrumbs'][] = 'Applicant Profile';

$pathToProfilePic = Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['unknownUserImagePath'];
if ($model->profile_pic_id != 0) {
    $readAttachment = \common\models\DocAttach::findOne($model->profile_pic_id);
    $pathToProfilePic = Yii::getAlias('@web') . '/uploads/resume/' . $model->user_id . '/' . $readAttachment->file_name_sys;
}
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Your applicant profile
        </small>
        <?php // Html::a('<i class="fa fa-pencil green icon-animated-vertical"></i>', ['user-profile/update'], ['class' => 'pull-right']) ?>
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
                            <img id="avatar" class="editable img-responsive" style="max-width: 234px" alt="Alex's Avatar" src="<?= $pathToProfilePic ?>" />
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
                            <span class="bigger-175 blue"><?= count(\common\models\JobApplication::find()->where(['user_id' => $user_id])->all()) ?></span>

                            <br />
                            Submission
                        </div>

                        <div class="grid2">
                            <span class="bigger-175 green"><?= count(\common\models\JobApplication::find()->where(['user_id' => $user_id, 'status' => 2])->all()) ?></span>

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
                                        <a data-toggle="tab" href="#personal_information">Personal Information <i class="fa fa-user green"></i></a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#education">Education & Experience <i class="fa fa-graduation-cap red"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /section:custom/widget-box.tabbed -->
                        </div>
                        <div class="widget-body">
                            <div class="widget-main padding-6">
                                <div class="tab-content">
                                    <div id="personal_information" class="tab-pane in active">
                                        <div class="profile-user-info profile-user-info-striped">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Full name </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="username"><?= $model->first_name . " " . $model->last_name ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> NRIC </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="mobile_no"><?= $model->nric ?></span>
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
                                                <div class="profile-info-name"> Address </div>
                                                <div class="profile-info-value">
                                                    <?= $model->address->fullAddress ?>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Marital Status </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="about"><?= \common\models\Reference::getDesc('marital_status', $model->marital_status) ?></span>
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
                                                        if ($user_doc)
                                                            echo Html::a($user_doc->docAttach->file_name, ['user-profile/download-attachment', 'id' => $user_doc->doc_attach_id, 'user_id' => $model->user_id]);
                                                        else
                                                            echo "Not Submitted";
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="education" class="tab-pane">
                                        <div class="profile-user-info profile-user-info-striped">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Highest Qualification </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="username"><?= \common\models\Reference::getDesc('qualification', $model->qualification) ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Skills </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="mobile_no">
                                                        <?php
                                                        $tmparr = explode(',', $model->skills);
                                                        $tmp = array();
                                                        foreach ($tmparr as $x) {
                                                            $tmp[] = \common\models\Reference::getDesc('skills', $x);
                                                        }
                                                        echo implode(',<br>', $tmp);
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Leadership Experience </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="mobile_no">
                                                        <?php
                                                        $tmparr = explode(',', $model->leadership_experience);
                                                        $tmp = array();
                                                        foreach ($tmparr as $x) {
                                                            $tmp[] = \common\models\Reference::getDesc('leadership_exp', $x);
                                                        }
                                                        echo implode(',<br>', $tmp);
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Previous Job Field </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="home_no"><?= \common\models\Reference::getDesc('job_field', $model->previous_job_field) ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Year of Working Experience </div>
                                                <div class="profile-info-value">
                                                    <?= $model->working_experience ?>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Expected Salary </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="about">RM<?= $model->expected_salary ?></span>
                                                </div>
                                            </div>
                                        </div>
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