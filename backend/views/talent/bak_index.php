<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Searching Specifically');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Searching Job Seeker Specifically by Criteria
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <div class="talent-index">
            <?= $this->render('_search', ['model' => $searchModel]); ?>  
            <button id="open_search" style="display: none;" class="btn btn-block btn-primary">Search Result (Click to open Search Box)</button>
            <div id="talent-grid-view" style="display: none">
                <?php Pjax::begin(['id' => 'talent-grid']); ?>  
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
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
                <?php Pjax::end(); ?>
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