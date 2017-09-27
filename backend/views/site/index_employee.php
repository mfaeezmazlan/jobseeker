<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
$this->title = 'Latest job announcement';
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <div class="site-index">
            <div class="body-content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <!-- #section:pages/pricing.large -->
                        <?php
                        $counter = 0;
                        $total = count($modelJobList);
                        $noCol = 12;
                        foreach ($modelJobList as $joblist) {
                            $color = ['blue', 'dark', 'green', 'orange', 'red'];
                            $colorBtn = ['primary', 'inverse', 'success', 'warning', 'danger'];
                            $rand = rand(0, 4);
                            if ($counter > 3)
                                $counter = 0;
                            if ($counter == 0) {
                                ?>
                                <div class="row">
                                    <?php
                                }
                                ?>
                                <div class="col-xs-6 col-sm-3 pricing-box">
                                    <div class="widget-box widget-color-<?= $color[$rand] ?>">
                                        <div class="widget-header">
                                            <h5 class="widget-title bigger"><?= $joblist->position ?></h5>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <ul class="list-unstyled spaced2">
                                                    <li>
                                                        <i class="ace-icon fa fa-check green"></i>
                                                        Bachelor in <?= $joblist->field ?>
                                                    </li>
                                                    <li>
                                                        <i class="ace-icon fa fa-check green"></i>
                                                        <?= $joblist->description ?>
                                                    </li>
                                                </ul>
                                                <hr />
                                                <div class="price">
                                                    RM<?= $joblist->salary ?>
                                                    <small>/month</small>
                                                </div>
                                            </div>
                                            <div>
                                                <?= Html::a('<i class="ace-icon fa fa-check-circle bigger-110"></i><span>Apply</span>', ['job-list/view-application', 'id' => $joblist->id], ['class' => 'btn btn-block btn-' . $colorBtn[$rand]]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($counter == 3) {
                                    ?>
                                </div>
                                <?php
                            }
                            $counter++;
                        }
                        ?>

                        <!-- /section:pages/pricing.large -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div>
    </div>
</div>
