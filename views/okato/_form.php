<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Okato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="okato-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod_okato')->textInput() ?>

    <?= $form->field($model, 'name_okato')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
