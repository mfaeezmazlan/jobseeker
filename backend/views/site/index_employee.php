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
                                                <i class="ace-icon fa fa-shopping-cart bigger-110"></i>
                                                <span>Buy</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3 pricing-box">
                                <div class="widget-box widget-color-orange">
                                    <div class="widget-header">
                                        <h5 class="widget-title bigger lighter">Starter Package</h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <ul class="list-unstyled spaced2">
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    50 GB Disk Space
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    1 TB Bandwidth
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    1000 Email Accounts
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    100 MySQL Databases
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    $25 Ad Credit
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Free Domain
                                                </li>
                                            </ul>
                                            <hr />
                                            <div class="price">
                                                $10
                                                <small>/month</small>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-block btn-warning">
                                                <i class="ace-icon fa fa-shopping-cart bigger-110"></i>
                                                <span>Buy</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3 pricing-box">
                                <div class="widget-box widget-color-blue">
                                    <div class="widget-header">
                                        <h5 class="widget-title bigger lighter">Business Package</h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <ul class="list-unstyled spaced2">
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    200 GB Disk Space
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Unlimited Bandwidth
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    1000 Email Accounts
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    200 MySQL Databases
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    $25 Ad Credit
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Free Domain
                                                </li>
                                            </ul>
                                            <hr />
                                            <div class="price">
                                                $15
                                                <small>/month</small>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-block btn-primary">
                                                <i class="ace-icon fa fa-shopping-cart bigger-110"></i>
                                                <span>Buy</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3 pricing-box">
                                <div class="widget-box widget-color-green">
                                    <div class="widget-header">
                                        <h5 class="widget-title bigger lighter">Ultimate Package</h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <ul class="list-unstyled spaced2">
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Unlimited Space
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Unlimited Bandwidth
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Unlimited Email Accounts
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    Unlimited MySQL Databases
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    $50 Ad Credit
                                                </li>
                                                <li>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    2 Free Domains
                                                </li>
                                            </ul>
                                            <hr />
                                            <div class="price">
                                                $25
                                                <small>/month</small>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-block btn-success">
                                                <i class="ace-icon fa fa-shopping-cart bigger-110"></i>
                                                <span>Buy</span>
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
