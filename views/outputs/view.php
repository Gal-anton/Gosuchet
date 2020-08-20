<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Outputs */

$this->title = $model->kod_output;
$this->params['breadcrumbs'][] = ['label' => 'Виды результата', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outputs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_output], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_output], [
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
            'id_output',
            'kod_output',
            'name_output',
            'id_fun',
        ],
    ]) ?>

</div>
