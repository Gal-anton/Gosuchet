<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Oktmo */

$this->title = $model->kod_oktmo;
$this->params['breadcrumbs'][] = ['label' => 'ОКТМО', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oktmo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_oktmo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_oktmo], [
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
            'id_oktmo',
            'kod_oktmo',
            'name_oktmo',
            'population',
        ],
    ]) ?>

</div>
