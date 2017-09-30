<?php

use yii\helpers\Html;

$assignmentRole = \common\models\AuthAssignment::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
?>
<div id="sidebar" class="sidebar responsive">
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'fixed')
        } catch (e) {
        }
    </script>
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>
            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>
            <!-- #section:basics/sidebar.layout.shortcuts -->
            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>
            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
            <!-- /section:basics/sidebar.layout.shortcuts -->
        </div>
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>
            <span class="btn btn-info"></span>
            <span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->



    <ul class="nav nav-list" id="nav_main">
        <li class="" id="nav_1">
            <?= Html::a("<i class='menu-icon fa fa-tachometer'></i><span class='menu-text'> Dashboard </span>", ['site/index']) ?>
            <b class="arrow"></b>
        </li>

        <?php if ($assignmentRole->item_name == 'employee'): ?>
            <li class="" id="nav_2">
                <?= Html::a("<i class='menu-icon fa fa-check'></i><span class='menu-text'> Job Application </span>", ['job-list/application']) ?>
                <b class="arrow"></b>
            </li>
        <?php endif; ?>

        <?php if ($assignmentRole->item_name == 'company'): ?>
            <li class="" id="nav_3">
                <?= Html::a("<i class='menu-icon fa fa-search'></i><span class='menu-text'> Talent Search </span>", ['talent/search']) ?>
                <b class="arrow"></b>
            </li>
            <li class="" id="nav_6">
                <?= Html::a("<i class='menu-icon fa fa-search-plus'></i><span class='menu-text'> Search Specifically </span>", ['talent/index']) ?>
                <b class="arrow"></b>
            </li>
            <li class="" id="nav_5">
                <?= Html::a("<i class='menu-icon fa fa-graduation-cap'></i><span class='menu-text'> Job List </span>", ['job-list/index']) ?>
                <b class="arrow"></b>
            </li>
        <?php endif; ?>
        <?php if ($assignmentRole->item_name == 'admin'): ?>
            <li class="" id="nav_4">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-cogs"></i>
                    <span class="menu-text">
                        System
                    </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="" id="nav_4_1">
                        <?= Html::a("<span class='menu-text'> Manage User </span>", ['user/index']) ?>
                        <b class="arrow"></b>
                    </li>
                    <li class="" id="nav_4_2">
                        <?= Html::a("<span class='menu-text'> Manage References </span>", ['reference/index']) ?>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
    </ul><!-- /.nav-list -->
    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'collapsed');
            $(".nav .nav-list li").click(function () {
                console.log('clicked');
            });
        } catch (e) {
        }
    </script>
</div>