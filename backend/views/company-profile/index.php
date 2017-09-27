<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanyProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Company Profiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Company Profile'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user_id',
            'address_id',
            'profile_pic_id',
            'company_name',
            // 'registration_no',
            // 'mobile_no',
            // 'office_no',
            // 'description',
            ['class' => 'yii\grid\ActionColumn','headerOptions' => ['style' => 'width:75px'],'header' => 'Action'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
