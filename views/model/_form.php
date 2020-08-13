<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Model */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod_mod')->textInput() ?>

    <?= $form->field($model, 'name_mod')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
