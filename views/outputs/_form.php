<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Outputs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outputs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod_output')->textInput() ?>

    <?= $form->field($model, 'name_output')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_fun')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
