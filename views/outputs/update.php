<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Outputs */

$this->title = 'Обновить вид результата: ' . $model->kod_output;
$this->params['breadcrumbs'][] = ['label' => 'Виды результата', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kod_output, 'url' => ['view', 'id' => $model->id_output]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="outputs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
