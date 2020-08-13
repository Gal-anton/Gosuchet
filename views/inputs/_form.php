<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Inputs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inputs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod_input')->textInput() ?>

    <?= $form->field($model, 'name_input')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_fun')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
