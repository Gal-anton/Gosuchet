<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Model */

$this->title = 'Обновить модель: ' . $model->name_mod;
$this->params['breadcrumbs'][] = ['label' => 'Модели', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_mod, 'url' => ['view', 'id' => $model->id_mod]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
