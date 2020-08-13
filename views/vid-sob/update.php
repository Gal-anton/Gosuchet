<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\VidSob */

$this->title = 'Update Vid Sob: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Vid Sobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_okfs, 'url' => ['view', 'id' => $model->id_okfs]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vid-sob-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
