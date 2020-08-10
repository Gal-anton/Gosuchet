<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Okato */

$this->title = 'Update Okato: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Okatos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_okato, 'url' => ['view', 'id' => $model->id_okato]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="okato-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
