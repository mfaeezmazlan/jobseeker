<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
$this->title = 'AMH Reality Enterprise';
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
</div><!-- /.page-header -->
<div class="row">
    <div class="space-8"></div>
    <div class="col-xs-12 col-md-6 col-lg-6 infobox-container">
        <h4>System Summary <i class="fa fa-cog fa-spin blue"></i></h4>
        <!-- #section:pages/dashboard.infobox -->
        <div class="infobox infobox-green">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-users"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?= $totalUser ?> Total</span>
                <div class="infobox-content">of Registered Users</div>
            </div>
        </div>
        <div class="infobox infobox-blue">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-tasks"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?= $totalJobList ?> Jobs</span>
                <div class="infobox-content">Offer</div>
            </div>
        </div>
        <div class="infobox infobox-pink" id="pending_box" title="View Pending Jobs" style="cursor: pointer;" onclick="location.href = 'index.php?r=job-list/index'">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-envelope"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?= $totalPendingApplication ?> Pending</span>
                <div class="infobox-content">Application</div>
            </div>
        </div>
    </div>
    <div class="vspace-12-sm"></div>
    <div class="col-xs-12 col-md-6 col-lg-6">
        <?php
        echo Highcharts::widget([
            'options' => [
                'chart' => [
                    'plotBackgroundColor' => null,
                    'plotBorderWidth' => null,
                    'plotShadow' => false,
                    'type' => 'pie',
                ],
                'title' => ['text' => 'Total User by Roles'],
                'tooltip' => [
//                    'pointFormat' => '{series.name}: <b>{point.percentage:.1f}%</b>'
                    'pointFormat' => '{series.name}: <b>{point.y}</b>'
                ],
                'series' => [
                    [
                        'name' => 'Total User',
                        'data' => [
                            ['name' => 'Staff', 'y' => $totalUserCompany],
                            ['name' => 'Jobseeker', 'y' => $totalUser],
                        ]
                    ]
                ],
                'credits' => false,
            ]
        ]);
        ?>
    </div>
</div>