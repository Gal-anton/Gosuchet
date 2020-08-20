<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Oktmo */

$this->title = 'Обновить ОКТМО: ' . $model->kod_oktmo;
$this->params['breadcrumbs'][] = ['label' => 'ОКТМО', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kod_oktmo, 'url' => ['view', 'id' => $model->id_oktmo]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="oktmo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
