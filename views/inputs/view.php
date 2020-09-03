<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Inputs */

$this->title = $model->name_input;
$this->params['breadcrumbs'][] = ['label' => 'Вид ресурса', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inputs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id_input], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_input], [
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
            'id_input',
            'kod_input',
            'name_input',
            //'id_fun',
            ['attribute' => 'name_fun', 'label' => 'Функция',
                'value' => function ($model) {
                    return $model->fun->kod_fun . " " . $model->fun->name_fun;
                },],
        ],
    ]) ?>

</div>
