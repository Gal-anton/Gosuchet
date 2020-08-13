<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Journal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_dmu')->textInput() ?>

    <?= $form->field($model, 'minX')->textInput() ?>

    <?= $form->field($model, 'maxX')->textInput() ?>

    <?= $form->field($model, 'minY')->textInput() ?>

    <?= $form->field($model, 'maxY')->textInput() ?>

    <?= $form->field($model, 'un_efficency')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
