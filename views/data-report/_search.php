<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\DataReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_data_report') ?>

    <?= $form->field($model, 'id_org') ?>

    <?= $form->field($model, 'id_dmu') ?>

    <?= $form->field($model, 'id_orgstr') ?>

    <?= $form->field($model, 'input') ?>

    <?php // echo $form->field($model, 'output') ?>

    <?php // echo $form->field($model, 'efficency') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
