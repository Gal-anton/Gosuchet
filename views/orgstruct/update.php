<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Orgstruct */

$this->title = 'Обновить запись: ' . $model->kod_orgstr;
$this->params['breadcrumbs'][] = ['label' => 'Орг. структуры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kod_orgstr, 'url' => ['view', 'id' => $model->id_orgstr]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="orgstruct-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
