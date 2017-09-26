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
                        <div class="row">
                            <!-- #section:pages/pricing.large -->
                            <div class="col-xs-6 col-sm-3 pricing-box">
                                <div class="widget-box widget-color-dark">
                                    <div class="widget-header">
                                        <h5 class="widget-title bigger lighter">Web Application Developer</h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <ul class="list-unstyled spaced2">
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Bachelor in Information & Technologies
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Fresh graduate are very welcome
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    HTML, CSS & Javascript
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Familiar with MVC Framework
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Medical Expenses
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Travelling Expenses
                                                </li>
                                            </ul>
                                            <hr />
                                            <div class="price">
                                                RM2500 ~ RM3000
                                                <small>/month</small>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-block btn-inverse">
                                                <i class="ace-icon fa fa-check-circle bigger-110"></i>
                                                <span>Apply</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3 pricing-box">
                                <div class="widget-box widget-color-orange">
                                    <div class="widget-header">
                                        <h5 class="widget-title bigger lighter">Electrical Engineer</h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <ul class="list-unstyled spaced2">
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Bachelor in Electrical Engineering
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Fresh graduate are very welcome
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    AutoCad & Electrical Drafting
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Willingly to learn new things
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Medical Expenses
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Travelling Expenses
                                                </li>
                                            </ul>
                                            <hr />
                                            <div class="price">
                                                RM2500 ~ RM3000
                                                <small>/month</small>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-block btn-warning">
                                                <i class="ace-icon fa fa-check-circle bigger-110"></i>
                                                <span>Apply</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3 pricing-box">
                                <div class="widget-box widget-color-blue">
                                    <div class="widget-header">
                                        <h5 class="widget-title bigger lighter">Accountant</h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <ul class="list-unstyled spaced2">
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Bachelor in Accounting
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Fresh graduate are very welcome
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Love calculating expenses
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Love business progression
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Medical Expenses
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Travelling Expenses
                                                </li>
                                            </ul>
                                            <hr />
                                            <div class="price">
                                                RM2600
                                                <small>/month</small>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-block btn-primary">
                                                <i class="ace-icon fa fa-check-circle bigger-110"></i>
                                                <span>Apply</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3 pricing-box">
                                <div class="widget-box widget-color-green">
                                    <div class="widget-header">
                                        <h5 class="widget-title bigger lighter">Mechanical Engineer</h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <ul class="list-unstyled spaced2">
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Bachelor in Mechanical Engineering
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Fresh graduate are very welcome
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    AutoCad & Mechanical Drafting
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Willingly to learn new things
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Medical Expenses
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Travelling Expenses
                                                </li>
                                            </ul>
                                            <hr />
                                            <div class="price">
                                                RM2700
                                                <small>/month</small>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-block btn-success">
                                                <i class="ace-icon fa fa-check-circle bigger-110"></i>
                                                <span>Apply</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /section:pages/pricing.large -->
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div>
    </div>
</div>
