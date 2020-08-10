<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ppo */

$this->title = 'Update Ppo: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Ppos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_ppo, 'url' => ['view', 'id' => $model->id_ppo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ppo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
