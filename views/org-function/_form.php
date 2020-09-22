<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\OrgFunction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="org-function-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod_fun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_fun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'autonomus')->checkbox() ?>

    <?= $form->field($model, 'budgetary')->checkbox() ?>

    <?= $form->field($model, 'kazennoe')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
