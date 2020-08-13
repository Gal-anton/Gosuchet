<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DmuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dmu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_dmu') ?>

    <?= $form->field($model, 'dmu_dmu') ?>

    <?= $form->field($model, 'kod_is') ?>

    <?= $form->field($model, 'id_fun') ?>

    <?= $form->field($model, 'id_mod') ?>

    <?php // echo $form->field($model, 'id_input') ?>

    <?php // echo $form->field($model, 'sum_input') ?>

    <?php // echo $form->field($model, 'id_output') ?>

    <?php // echo $form->field($model, 'sum_output') ?>

    <?php // echo $form->field($model, 'efficency') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
