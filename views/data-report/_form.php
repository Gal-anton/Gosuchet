<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\DataReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput() ?>

    <?= $form->field($model, 'report_year')->textInput() ?>

    <?= $form->field($model, 'report_staff_plan')->textInput() ?>

    <?= $form->field($model, 'report_staff_fact')->textInput() ?>

    <?= $form->field($model, 'report_sum_fin')->textInput() ?>

    <?= $form->field($model, 'report_sum_fot')->textInput() ?>

    <?= $form->field($model, 'id_orgstr')->textInput() ?>

    <?= $form->field($model, 'id_fun')->textInput() ?>

    <?= $form->field($model, 'resource_sum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
