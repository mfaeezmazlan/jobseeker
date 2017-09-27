
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;

$counter = Yii::$app->request->get('counter');

$form = ActiveForm::begin(['fieldConfig' => ['template' => "{label}\n{input}"]]);
?>
<div id="additionalPanel_<?= $counter ?>">
    <?php
    echo $form->field($model, 'skills[]', ['template' => '<div class="row"><div class="col-xs-10 col-md-9 col-lg-9">{label}{input}{error}{hint}</div><div class="col-xs-2 col-md-3 col-lg-3"><button onclick="delAdditionalPanel(' . $counter . ')" style="margin-top:26px" id="btnAddPanel" type="button" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-minus"></i></button></div></div>'])
            ->textInput(['placeholder' => 'Skills']);
    ?>
</div>