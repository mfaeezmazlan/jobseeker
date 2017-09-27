<?php

use yii\widgets\Breadcrumbs;
?>
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <!--<div class="card">-->
        <?=
        Breadcrumbs::widget([
            'options' => [
                'class' => 'breadcrumb breadcrumb-bg-blue-grey'
            ],
            'homeLink' => [
                'label' => Yii::t('yii', 'Dashboard'), 'url' => Yii::$app->homeUrl,
                'template' => "<li><a href='javascript:history.back()'><i class='material-icons col-white'>arrow_back</i></a>{link}</li>"
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]);
        ?>
    </div>
</div>