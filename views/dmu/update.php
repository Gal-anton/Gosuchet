<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Dmu */

$this->title = 'Изменить DMU: ' . $model->dmu_dmu;
$this->params['breadcrumbs'][] = ['label' => 'DMU', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_dmu, 'url' => ['view', 'id' => $model->id_dmu]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="dmu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
