<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Outputs */

$this->title = 'Update Outputs: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Outputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_output, 'url' => ['view', 'id' => $model->id_output]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="outputs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
