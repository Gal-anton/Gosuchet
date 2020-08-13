<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\search\DataReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_data_report') ?>

    <?= $form->field($model, 'id_org') ?>

    <?= $form->field($model, 'report_year') ?>

    <?= $form->field($model, 'report_staff_plan') ?>

    <?= $form->field($model, 'report_staff_fact') ?>

    <?php // echo $form->field($model, 'report_sum_fin') ?>

    <?php // echo $form->field($model, 'report_sum_fot') ?>

    <?php // echo $form->field($model, 'id_orgstr') ?>

    <?php // echo $form->field($model, 'id_fun') ?>

    <?php // echo $form->field($model, 'resource_sum') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
