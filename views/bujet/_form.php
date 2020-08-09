<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bujet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bujet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod_buj')->textInput() ?>

    <?= $form->field($model, 'name_buj')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
