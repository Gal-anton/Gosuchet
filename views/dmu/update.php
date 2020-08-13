<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dmu */

$this->title = 'Update Dmu: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Dmus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_dmu, 'url' => ['view', 'id' => $model->id_dmu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dmu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
