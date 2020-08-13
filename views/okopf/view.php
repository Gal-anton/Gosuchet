<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Okopf */

$this->title = $model->id_okopf;
$this->params['breadcrumbs'][] = ['label' => 'Okopfs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="okopf-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_okopf], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_okopf], [
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
            'id_okopf',
            'kod_okopf',
            'name_okopf',
        ],
    ]) ?>

</div>
