<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OkvedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Okveds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="okved-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Okved', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_okved',
            'kod_okved',
            'name_okved',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
