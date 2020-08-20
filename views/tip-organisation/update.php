<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tables\TipOrganisation */

$this->title = 'Обновить тип организации: ' . $model->name_tip;
$this->params['breadcrumbs'][] = ['label' => 'Tip Organisations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kod_tip . " " . $model->name_tip, 'url' => ['view', 'id' => $model->id_tip]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tip-organisation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
