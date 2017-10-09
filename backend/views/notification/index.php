<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1>
        <?= Html::encode($this->title) ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            My Notification
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <div class="notification-index">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'status',
                        'filter' => common\models\Reference::getList('notification_status'),
                        'value' => function($model) {
                            return common\models\Reference::getDesc('notification_status', $model->status);
                        }
                    ],
                    [
                        'attribute' => 'from',
                        'filter' => false,
                        'value' => function($model) {
                            return \backend\models\User::findOne($model->from)->userProfile->first_name;
                        }
                    ],
                    [
                        'attribute' => 'message',
                        'format' => 'raw',
                        'filter' => false,
                        'value' => function($model) {
                            return Html::a($model->message, 'index.php?r=' . $model->path);
                        }
                    ],
                    [
                        'attribute' => 'created_at',
                        'filter' => false,
                        'value' => function($model) {
                            return \common\components\DateHandler::resolveDateRead($model->created_at);
                        }
                    ]
                ],
            ]);
            ?>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->