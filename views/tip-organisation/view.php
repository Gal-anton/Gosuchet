<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TipOrganisation */

$this->title = $model->id_tip;
$this->params['breadcrumbs'][] = ['label' => 'Tip Organisations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tip-organisation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_tip], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_tip], [
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
            'id_tip',
            'kod_tip',
            'name_tip',
        ],
    ]) ?>

</div>
