<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JobListSkillsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Job List Skills');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-list-skills-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Job List Skills'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'job_list_id',
            'skills_name',
            'description',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
