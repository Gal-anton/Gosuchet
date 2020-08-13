<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inputs */

$this->title = 'Update Inputs: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Inputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_input, 'url' => ['view', 'id' => $model->id_input]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inputs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
