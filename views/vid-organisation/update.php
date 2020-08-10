<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VidOrganisation */

$this->title = 'Update Vid Organisation: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Vid Organisations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_vid, 'url' => ['view', 'id' => $model->id_vid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vid-organisation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
