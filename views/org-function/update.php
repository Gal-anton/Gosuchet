<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrgFunction */

$this->title = 'Update Org Function: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Org Functions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_fun, 'url' => ['view', 'id' => $model->id_fun]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="org-function-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
