<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bujet */

$this->title = 'Update Bujet: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Bujets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_buj, 'url' => ['view', 'id' => $model->id_buj]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bujet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
