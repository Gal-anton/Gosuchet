<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Okopf */

$this->title = 'Обновить ОКОПФ: ' . $model->kod_okopf;
$this->params['breadcrumbs'][] = ['label' => 'ОКОПФ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kod_okopf, 'url' => ['view', 'id' => $model->id_okopf]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="okopf-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
