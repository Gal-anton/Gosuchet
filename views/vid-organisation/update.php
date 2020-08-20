<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\VidOrganisation */

$this->title = 'Обновить вид организации: ' . $model->kod_vid;
$this->params['breadcrumbs'][] = ['label' => 'Вид организации', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kod_vid, 'url' => ['view', 'id' => $model->id_vid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vid-organisation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
