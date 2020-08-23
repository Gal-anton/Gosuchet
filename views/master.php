<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Master */
/* @var $form ActiveForm */
?>
<div class="master">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_model') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- master -->
