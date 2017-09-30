<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
$this->title = $model->first_name;
$this->params['breadcrumbs'][] = 'My Profile';

$pathToProfilePic = Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['unknownUserImagePath'];
if ($model->profile_pic_id != 0) {
    $pathToProfilePic = Yii::getAlias('@web') . '/uploads/resume/' . $model->user_id . '/' . $readAttachment->file_name_sys;
}
?>


<!-- Modal Dialog for Update Profile Picture -->
<div id="updateProfileDiv" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal Dialog content-->
        <?php
        $form = ActiveForm::begin([
                    'action' => ['update-profile-pic'],
                    'options' => ['enctype' => 'multipart/form-data']
        ]);
        ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update your profile picture</h4>
            </div>
            <div class="modal-body">

                <?= $form->field($modelUserProfileAttachment, 'file')->fileInput()->label('Profile Picture'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Make your profile awesome!!
        </small>
        <?= Html::a('<i class="fa fa-pencil green icon-animated-vertical"></i>', ['user-profile/update-staff-profile'], ['class' => 'pull-right']) ?>
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
                            <img title="Click to update" id="avatar" class="editable img-responsive" style="max-width: 234px" alt="Alex's Avatar" src="<?= $pathToProfilePic ?>" />
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
                            <h5 class="widget-title smaller">Company Profile</h5>
                            <!-- #section:custom/widget-box.tabbed -->
                            <div class="widget-toolbar no-border">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active">
                                        <a data-toggle="tab" href="#personal_information">Personal Information <i class="fa fa-user green"></i></a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#company_information">Company Information <i class="fa fa-briefcase red"></i></a>
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
                                        </div>
                                    </div>
                                    <div id="company_information" class="tab-pane">
                                        <div class="profile-user-info profile-user-info-striped">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Company Name </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="company_name"><?= $companyProfile->company_name ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Registration No </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="reg_no"><?= $companyProfile->registration_no ?></span>
                                                </div>
                                            </div>


                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Company Address </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="comp_mobile_no"><?= $companyProfile->address->fullAddress ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Company Mobile No </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="comp_mobile_no"><?= $companyProfile->mobile_no ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Company Office No </div>

                                                <div class="profile-info-value">
                                                    <span class="editable" id="comp_home_no"><?= $companyProfile->office_no ?></span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Description </div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="comp_descr"><?= $companyProfile->description ?></span>
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

<?php
$this->registerJs("
    $('document').ready(function(){         
        $('#avatar').click(function(){
            $('#updateProfileDiv').modal();
        });
    });
", \yii\web\View::POS_END);
?>