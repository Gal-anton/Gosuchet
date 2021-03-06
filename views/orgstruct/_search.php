<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\search\OrgstructSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orgstruct-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_orgstr') ?>

    <?= $form->field($model, 'kod_orgstr') ?>

    <?= $form->field($model, 'name_orgstr') ?>

    <?= $form->field($model, 'id_fun') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
