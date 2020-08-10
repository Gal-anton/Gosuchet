<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Okopf */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="okopf-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod_okopf')->textInput() ?>

    <?= $form->field($model, 'name_okopf')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
