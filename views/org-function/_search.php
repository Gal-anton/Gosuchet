<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrgFunctionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="org-function-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_fun') ?>

    <?= $form->field($model, 'kod_fun') ?>

    <?= $form->field($model, 'name_fun') ?>

    <?= $form->field($model, 'id_tip') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
