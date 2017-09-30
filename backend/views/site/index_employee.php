<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
$this->title = 'My Dashboard';
?>




<div class="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
</div><!-- /.page-header -->
<div class="row">
    <h4>Application Status <i class="fa fa-check-circle-o blue"></i></h4>
    <div class="col-xs-12">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'company_id',
                    'value' => function($model) {
                        return $model->company->company_name;
                    }
                ],
                [
                    'attribute' => 'field',
                    'value' => function($model) {
                        return common\models\Reference::getDesc('job_field', $model->field);
                    }
                ],
                'position',
                [
                    'attribute' => 'skills_require',
                    'format' => 'raw',
                    'value' => function($model) {
                        $arr = array();
                        $skills = explode(',', $model->skills_require);
                        foreach ($skills as $x) {
                            $arr[] = common\models\Reference::getDesc('skills', $x);
                        }
                        return implode(', ', $arr);
                    }
                ],
                [
                    'attribute' => 'status_application',
                    'header' => 'Application Status',
                    'format' => 'raw',
                    'value' => function($model) {
                        $data = \common\models\JobApplication::find()->where(['user_id' => Yii::$app->user->identity->id, 'job_list_id' => $model->id])->one();
                        if ($data)
                            return common\models\Reference::getDesc('status_application', $data->status);
                        else
                            return null;
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['style' => 'width:75px'],
                    'template' => '{view_application}',
                    'buttons' => [
                        'view_application' => function ($url, $model) {
                            return Html::a('<i class="fa fa-eye blue"></i>', ['job-list/view-application', 'id' => $model->id]);
                        },
                    ]
                ],
            ],
        ]);
        ?>
    </div>
</div>
<div class="hr hr8 hr-double hr-dotted"></div>
<div class="row">
    <h4>Latest Job Posts <i class="fa fa-info-circle blue"></i></h4>
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
                                        <i class="ace-icon fa fa-briefcase dark"></i>
                                        <?= $joblist->company->company_name ?>
                                    </li>
                                    <li>
                                        <i class="ace-icon fa fa-list-alt green"></i>
                                        <?= common\models\Reference::getDesc('job_field', $joblist->field) ?>
                                    </li>
                                    <li>
                                        <i class="ace-icon fa fa-info blue"></i>
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
</div>
