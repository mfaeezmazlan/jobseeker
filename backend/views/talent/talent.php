<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Talent Search');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Searching Talent
        </small>
    </h1>
</div><!-- /.page-header -->

<?php
if ($winnerModel) {
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="talent-highscore">
                <div>
                    <div id="user-profile-1" class="user-profile row">
                        <div class="col-xs-12 col-sm-5 center">
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
                                            <span class="white"><?= $winnerModel->first_name . " " . $winnerModel->last_name ?></span>
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
                                    <span class="bigger-175 blue"><?= count(\common\models\JobApplication::find()->where(['user_id' => $winnerModel->user_id])->all()) ?></span>

                                    <br />
                                    Submission
                                </div>

                                <div class="grid2">
                                    <span class="bigger-175 green"><?= count(\common\models\JobApplication::find()->where(['user_id' => $winnerModel->user_id, 'status' => 2])->all()) ?></span>

                                    <br />
                                    Approval
                                </div>
                            </div>

                            <!-- /section:custom/extra.grid -->
                            <div class="hr hr16 dotted"></div>
                        </div>

                        <div class="col-xs-12 col-sm-7">
                            <?php
                            echo miloschuman\highcharts\Highcharts::widget([
                                'options' => [
                                    'chart' => [
                                        'plotBackgroundColor' => null,
                                        'plotBorderWidth' => null,
                                        'plotShadow' => false,
                                        'type' => 'pie',
                                    ],
                                    'title' => ['text' => 'Percentage Match and Lost'],
                                    'tooltip' => [
                                        'pointFormat' => '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    ],
                                    'series' => [
                                        [
                                            'name' => 'Percentage',
                                            'data' => [
                                                ['name' => 'Criteria Match', 'y' => $highestScore],
                                                ['name' => 'Criteria Lost', 'y' => Yii::$app->session->get('totalSearch') - $highestScore],
                                            ]
                                        ]
                                    ]
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<div class="row">
    <div class="col-xs-12">
        <div class="talent-talent">
            <?php // $this->render('_search', ['model' => $searchModel]);   ?>  
            <!--<button id="open_search" style="display: none;" class="btn btn-block btn-primary">Search Result (Click to open Search Box)</button>-->
            <div id="talent-grid-view" style="display: block">
                <?=
                GridView::widget([
                    'dataProvider' => $provider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'search_criteria',
                            'header' => 'Percentage (%)',
                            'format' => 'raw',
                            'enableSorting' => true,
                            'value' => function($model) {
                                $score = 0;
                                if ($model->qualification == Yii::$app->session->get('qualificationSearch') && Yii::$app->session->get('qualificationSearch') != '')
                                    $score++;
                                if ($model->previous_job_field == Yii::$app->session->get('previousJobFieldSearch') && Yii::$app->session->get('previousJobFieldSearch') != '')
                                    $score++;
                                if ($model->working_experience == Yii::$app->session->get('workingExperienceSearch') && Yii::$app->session->get('workingExperienceSearch') != '')
                                    $score++;

                                if ($model->skills != '' || $model->skills != null) {
                                    $arr1 = explode(',', $model->skills);
                                    $arr2 = explode(',', Yii::$app->session->get('skillsSearch'));
                                    $intersect = array_intersect($arr1, $arr2);
                                    $score = $score + count($intersect);
                                }

                                if ($model->language != '' || $model->language != null) {
                                    $arr1 = explode(',', $model->language);
                                    $arr2 = explode(',', Yii::$app->session->get('languageSearch'));
                                    $intersect = array_intersect($arr1, $arr2);
                                    $score = $score + count($intersect);
                                }

                                if ($model->leadership_experience != '' || $model->leadership_experience != null) {
                                    $arr1 = explode(',', $model->leadership_experience);
                                    $arr2 = explode(',', Yii::$app->session->get('leadershipExpSearch'));
                                    $intersect = array_intersect($arr1, $arr2);
                                    $score = $score + count($intersect);
                                }

                                $totalSearch = Yii::$app->session->get('totalSearch');
                                if ($totalSearch == 0) {
                                    return '100%';
                                } else {
                                    return number_format((($score / Yii::$app->session->get('totalSearch')) * 100), 2) . "%";
                                }
                            }
                        ],
                        [
                            'attribute' => 'first_name',
                            'header' => 'Name',
                            'format' => 'raw',
                            'value' => function($model) {
                                return Html::a($model->first_name . " " . $model->last_name, ['user-profile/view-profile', 'id' => $model->user_id]);
                            }
                        ],
                        [
                            'attribute' => 'language',
                            'value' => function($model) {
                                $tmparr = explode(',', $model->language);
                                $tmp = array();
                                foreach ($tmparr as $x) {
                                    $tmp[] = \common\models\Reference::getDesc('language', $x);
                                }
                                return implode(', ', $tmp);
                            }
                        ],
                        [
                            'attribute' => 'skills',
                            'value' => function($model) {
                                $tmparr = explode(',', $model->skills);
                                $tmp = array();
                                foreach ($tmparr as $x) {
                                    $tmp[] = \common\models\Reference::getDesc('skills', $x);
                                }
                                return implode(', ', $tmp);
                            }
                        ],
                        [
                            'attribute' => 'leadership_experience',
                            'value' => function($model) {
                                $tmparr = explode(',', $model->leadership_experience);
                                $tmp = array();
                                foreach ($tmparr as $x) {
                                    $tmp[] = \common\models\Reference::getDesc('leadership_exp', $x);
                                }
                                return implode(', ', $tmp);
                            }
                        ],
                        'working_experience',
                        [
                            'attribute' => 'expected_salary',
                            'contentOptions' => ['style' => 'text-align:right;'],
                            'value' => function($model) {
                                return "RM" . number_format($model->expected_salary, 2);
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width:75px'],
                            'header' => 'Action',
                            'template' => '{download_resume} {reject} {accept}',
                            'buttons' => [
                                'download_resume' => function ($url, $model) {
                                    $user_doc = common\models\UserDoc::find()->where(['user_id' => $model->user_id])->orderBy(['id' => SORT_DESC])->one();
                                    if ($user_doc)
                                        return Html::a('<i class="fa fa-download blue"></i>', ['user-profile/download-attachment', 'id' => $user_doc->doc_attach_id, 'user_id' => $model->user_id], ['data-pjax' => '0', 'title' => 'Download Resume']);
                                    else
                                        return Html::a('<i class="fa fa-download dark"></i>', '#', ['data-pjax' => '0', 'title' => 'Resume not submitted yet']);
                                },
                                'reject' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-times red"></i>', ['job-list/view-application', 'id' => $model->id], ['data-pjax' => '0', 'title' => 'Reject']);
                                },
                                'accept' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-check green"></i>', ['job-list/view-application', 'id' => $model->id], ['data-pjax' => '0', 'title' => 'Accept']);
                                }
                            ]
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->
<?php
$this->registerJs("
    $('document').ready(function(){ 
        $('#talent-search').on('pjax:end', function() {
            $.pjax.reload({container:'#talent-grid'});
            $('#talent_div').fadeOut('slow',function(){
                $('#open_search').fadeIn('slow');
                $('#talent-grid-view').fadeIn('slow');
            });
        }); 
        $('#open_search').click(function(){
            $('#open_search').fadeOut('slow');
            $('#talent-grid-view').fadeOut('slow',function(){
                $('#talent_div').fadeIn('slow');
            });
        });
    });    
", \yii\web\View::POS_END);
?>