<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Okato */

$this->title = $model->id_okato;
$this->params['breadcrumbs'][] = ['label' => 'Okatos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="okato-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_okato], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_okato], [
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
            'id_okato',
            'kod_okato',
            'name_okato',
        ],
    ]) ?>

</div>
