<?php
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */

$this->title = 'JobSeeker';
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
</div><!-- /.page-header -->
<div class="row">
    <div class="col-xs-12">
        <div class="site-index">
            <div class="body-content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <?php
                        echo Highcharts::widget([
                            'options' => [
                                'title' => ['text' => 'Total User'],
                                'xAxis' => [
                                    'categories' => ['Apples', 'Bananas', 'Oranges']
                                ],
                                'yAxis' => [
                                    'title' => ['text' => 'Fruit eaten']
                                ],
                                'series' => [
                                    ['name' => 'Jane', 'data' => [1, 0, 4, 3, 2, 1, 9, 3]],
                                    ['name' => 'John', 'data' => [5, 7, 3, 6, 5, 2, 1, 3]]
                                ],
                                'credits' => false,
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>