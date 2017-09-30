<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\JobList */
$this->title = common\models\Reference::getDesc('job_field', $model->field) . ": " . $model->position;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
</div><!-- /.page-header -->
<div class="row">
    <h4>Job details <i class="fa fa-info blue"></i></h4>
    <div class="col-xs-12">
        <div class="job-application-view">
            <p>
                <?= Html::a(Yii::t('app', 'Update <i class="fa fa-pencil"></i>'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?=
                Html::a(Yii::t('app', 'Delete <i class="fa fa-trash"></i>'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ])
                ?>
            </p>

            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
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
                    'salary',
                    'description',
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
                ],
            ]);
            ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->
<div class="hr hr8 hr-double hr-dotted"></div>
<div class="row">
    <h4>List of Applicant <i class="fa fa-list blue"></i></h4>
    <div class="col-xs-12">

        <?=
        GridView::widget([
            'dataProvider' => $modelJobApplicationProvider,
//                    'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'user_id',
                    'format' => 'raw',
                    'value' => function($model) {
                        $data = backend\models\User::findOne($model->user_id);
                        return Html::a($data->userProfile->fullName, ['user-profile/view-profile', 'id' => $model->user_id]);
                    }
                ],
                'created_at',
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        return common\models\Reference::getDesc('status_application', $model->status);
                    }
                ],
                'updated_at',
                [
                    'attribute' => 'updated_by',
                    'value' => function($model) {
                        $data = backend\models\User::findOne($model->updated_by);
                        return $data->userProfile->fullName;
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
                            if ($model->status == 0)
                                return Html::a('<i class="fa fa-times red"></i>', ['job-list/reject-application', 'id' => $model->id], ['data-pjax' => '0', 'title' => 'Reject']);
                            else
                                return null;
                        },
                        'accept' => function ($url, $model) {
                            if ($model->status == 0)
                                return Html::a('<i class="fa fa-check green"></i>', ['job-list/accept-application', 'id' => $model->id], ['data-pjax' => '0', 'title' => 'Accept']);
                            else
                                return null;
                        }
                    ]
                ],
            ],
        ]);
        ?>
    </div><!-- /.col -->
</div><!-- /.row -->