<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrgFunction */

$this->title = $model->id_fun;
$this->params['breadcrumbs'][] = ['label' => 'Org Functions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-function-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_fun], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_fun], [
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
            'id_fun',
            'kod_fun',
            'name_fun',
            'id_tip',
        ],
    ]) ?>

</div>
