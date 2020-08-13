<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Orgstruct */

$this->title = 'Update Orgstruct: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Orgstructs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_orgstr, 'url' => ['view', 'id' => $model->id_orgstr]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orgstruct-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
