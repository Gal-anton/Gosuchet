<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Organisation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organisation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reg_num')->textInput() ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inn')->textInput() ?>

    <?= $form->field($model, 'kod_ppo')->textInput() ?>

    <?= $form->field($model, 'id_tip')->textInput() ?>

    <?= $form->field($model, 'id_vid')->textInput() ?>

    <?= $form->field($model, 'id_okved')->textInput() ?>

    <?= $form->field($model, 'id_okato')->textInput() ?>

    <?= $form->field($model, 'id_oktmo')->textInput() ?>

    <?= $form->field($model, 'id_okfs')->textInput() ?>

    <?= $form->field($model, 'id_buj')->textInput() ?>

    <?= $form->field($model, 'id_okopf')->textInput() ?>

    <?= $form->field($model, 'id_owner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
