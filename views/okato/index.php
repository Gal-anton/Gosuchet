<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OkatoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Okatos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="okato-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Okato', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_okato',
            'kod_okato',
            'name_okato',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
