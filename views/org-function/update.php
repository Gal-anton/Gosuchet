<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tables\OrgFunction */

$this->title = 'Обновить функцию:' . $model->name_fun;
$this->params['breadcrumbs'][] = ['label' => 'Функции', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_fun, 'url' => ['view', 'id' => $model->id_fun]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="org-function-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
