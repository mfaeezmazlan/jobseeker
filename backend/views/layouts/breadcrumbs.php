<?php

use yii\widgets\Breadcrumbs;
?>

<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try {
            ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {
        }
    </script>
    <!--<div class="card">-->
    <?=
    Breadcrumbs::widget([
        'options' => [
            'class' => 'breadcrumb breadcrumb-bg-blue-grey'
        ],
        'homeLink' => [
            'label' => Yii::t('yii', 'Dashboard'), 'url' => Yii::$app->homeUrl,
            'template' => "<li><a title='Back' href='javascript:history.back()'><i class='fa fa-arrow-circle-left fa-lg blue'></i></a> {link}</li>"
        ],
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]);
    ?>
</div>