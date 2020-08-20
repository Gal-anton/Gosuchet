<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Organisation */

$this->title = $model->short_name;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['index']];
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
            ['attribute' => 'tip_name', 'label' => 'Тип организации',
                'value' => function ($model) {
                    return $model->tip->kod_tip . " " . $model->tip->name_tip;
                },],
            ['attribute' => 'vid_name', 'label' => 'Вид организации',
                'value' => function ($model) {
                    return $model->idV->kod_vid . " " . $model->idV->name_vid;
                },],
            //'id_okved',
            ['attribute' => 'id_okved', 'label' => 'ОКВЭД',
                'value' => function ($model) {
                    return $model->okved->kod_okved . " " . $model->okved->name_okved;
                },],
            //'id_okato',
            ['attribute' => 'id_okato', 'label' => 'ОКАТО',
                'value' => function ($model) {
                    return $model->okato->kod_okato . " " . $model->okato->name_okato;
                },],
            //'id_oktmo',
            ['attribute' => 'id_oktmo', 'label' => 'ОКТМО',
                'value' => function ($model) {
                    return $model->oktmo->kod_oktmo . " " . $model->oktmo->name_oktmo;
                },],
            //'id_okfs',
            ['attribute' => 'id_okfs', 'label' => 'Вид собственности(ОКФС)',
                'value' => function ($model) {
                    return $model->okfs->kod_okfs . " " . $model->okfs->name_okfs;
                },],
            //'id_buj',
            //'id_okopf',
            ['attribute' => 'id_okopf', 'label' => 'Вид организации',
                'value' => function ($model) {
                    return $model->okopf->kod_okopf . " " . $model->okopf->name_okopf;
                },],
            'id_owner',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
