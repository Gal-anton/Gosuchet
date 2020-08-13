<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Organisation */

$this->title = $model->id_org;
$this->params['breadcrumbs'][] = ['label' => 'Organisations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_org], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_org], [
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
            'id_org',
            'reg_num',
            'full_name:ntext',
            'short_name',
            'inn',
            'ppo',
            'id_tip',
            'id_vid',
            'id_okved',
            'id_okato',
            'id_oktmo',
            'id_okfs',
            'id_buj',
            'id_okopf',
            'id_owner',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
