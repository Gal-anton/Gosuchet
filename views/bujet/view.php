<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bujet */

$this->title = $model->id_buj;
$this->params['breadcrumbs'][] = ['label' => 'Bujets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bujet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_buj], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_buj], [
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
            'id_buj',
            'kod_buj',
            'name_buj',
        ],
    ]) ?>

</div>
