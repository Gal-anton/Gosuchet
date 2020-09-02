<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\tables\OrgFunction */

$this->title = $model->name_fun;
$this->params['breadcrumbs'][] = ['label' => 'Функции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-function-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id_fun], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_fun], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_fun',
            'kod_fun',
            'name_fun',
            'autonomus',
            'budgetary',
            'kazennoe',
        ],
    ]) ?>

</div>
