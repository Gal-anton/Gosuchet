<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dmu */

$this->title = $model->id_dmu;
$this->params['breadcrumbs'][] = ['label' => 'Dmus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dmu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_dmu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_dmu], [
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
            'id_dmu',
            'dmu_dmu',
            'kod_is',
            'id_fun',
            'id_mod',
            'id_input',
            'sum_input',
            'id_output',
            'sum_output',
            'efficency',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
