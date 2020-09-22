<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\JournalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Журнал';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_j',
            //'id_dmu',
            ['attribute' => 'dmu_dmu', 'label' => 'DMU', 'value' => 'dmu.dmu_dmu'],
            'minX',
            'maxX',
            'minY',
            'maxY',
            'un_efficency',
            'created_at',

        ],
    ]); ?>
</div>
