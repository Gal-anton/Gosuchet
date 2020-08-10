<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VidOrganisation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vid-organisation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod_vid')->textInput() ?>

    <?= $form->field($model, 'name_vid')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
