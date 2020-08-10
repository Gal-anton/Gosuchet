<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VidSob */

$this->title = $model->id_okfs;
$this->params['breadcrumbs'][] = ['label' => 'Vid Sobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vid-sob-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_okfs], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_okfs], [
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
            'id_okfs',
            'kod_okfs',
            'name_okfs',
        ],
    ]) ?>

</div>
