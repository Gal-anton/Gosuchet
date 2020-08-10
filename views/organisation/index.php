<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrganisationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Organisations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Organisation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_org',
            'reg_num',
            'full_name',
            'short_name',
            'inn',
            //'kod_ppo',
            //'id_tip',
            //'id_vid',
            //'id_okved',
            //'id_okato',
            //'id_oktmo',
            //'id_okfs',
            //'id_buj',
            //'id_okopf',
            //'id_owner',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>