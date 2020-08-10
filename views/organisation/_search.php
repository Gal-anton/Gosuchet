<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrganisationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organisation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_org') ?>

    <?= $form->field($model, 'reg_num') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'short_name') ?>

    <?= $form->field($model, 'inn') ?>

    <?php // echo $form->field($model, 'kod_ppo') ?>

    <?php // echo $form->field($model, 'id_tip') ?>

    <?php // echo $form->field($model, 'id_vid') ?>

    <?php // echo $form->field($model, 'id_okved') ?>

    <?php // echo $form->field($model, 'id_okato') ?>

    <?php // echo $form->field($model, 'id_oktmo') ?>

    <?php // echo $form->field($model, 'id_okfs') ?>

    <?php // echo $form->field($model, 'id_buj') ?>

    <?php // echo $form->field($model, 'id_okopf') ?>

    <?php // echo $form->field($model, 'id_owner') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
