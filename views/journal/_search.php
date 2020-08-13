<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\search\JournalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_j') ?>

    <?= $form->field($model, 'id_dmu') ?>

    <?= $form->field($model, 'minX') ?>

    <?= $form->field($model, 'maxX') ?>

    <?= $form->field($model, 'minY') ?>

    <?php // echo $form->field($model, 'maxY') ?>

    <?php // echo $form->field($model, 'un_efficency') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
