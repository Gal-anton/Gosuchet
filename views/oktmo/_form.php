<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Oktmo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oktmo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod_oktmo')->textInput() ?>

    <?= $form->field($model, 'name_oktmo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'population')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
