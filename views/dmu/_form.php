<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Dmu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dmu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dmu_dmu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kod_is')->textInput() ?>

    <?= $form->field($model, 'id_fun')->textInput() ?>

    <?= $form->field($model, 'id_mod')->textInput() ?>

    <?= $form->field($model, 'id_input')->textInput() ?>

    <?= $form->field($model, 'sum_input')->textInput() ?>

    <?= $form->field($model, 'id_output')->textInput() ?>

    <?= $form->field($model, 'sum_output')->textInput() ?>

    <?= $form->field($model, 'efficency')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
