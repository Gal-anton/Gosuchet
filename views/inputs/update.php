<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Inputs */

$this->title = "Изменить: $model->name_input";
$this->params['breadcrumbs'][] = ['label' => 'Вид ресурса', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_input, 'url' => ['view', 'id' => $model->id_input]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="inputs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
