<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Journal */

$this->title = $model->id_j;
$this->params['breadcrumbs'][] = ['label' => 'Journals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_j], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_j], [
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
            'id_j',
            //'id_dmu',
            ['attribute' => 'dmu_dmu', 'label' => 'DMU',
                'value' => function ($model) {
                    return $model->dmu->id_dmu . " " . $model->dmu->dmu_dmu;
                },],
            'minX',
            'maxX',
            'minY',
            'maxY',
            'un_efficency',
            'created_at',
        ],
    ]) ?>

</div>
