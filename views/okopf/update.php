<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Okopf */

$this->title = 'Update Okopf: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Okopfs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_okopf, 'url' => ['view', 'id' => $model->id_okopf]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="okopf-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
