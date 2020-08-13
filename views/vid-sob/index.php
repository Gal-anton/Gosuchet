<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\VidSobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vid Sobs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vid-sob-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vid Sob', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_okfs',
            'kod_okfs',
            'name_okfs',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
