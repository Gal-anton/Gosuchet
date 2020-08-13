<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Okved */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="okved-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod_okved')->textInput() ?>

    <?= $form->field($model, 'name_okved')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
