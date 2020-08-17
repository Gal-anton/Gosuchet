<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\DataReport */

$this->title = "Обновить отчет: {$model->id_data_report}";
$this->params['breadcrumbs'][] = ['label' => 'Отчетные данные', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_data_report, 'url' => ['view', 'id' => $model->id_data_report]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="data-report-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
