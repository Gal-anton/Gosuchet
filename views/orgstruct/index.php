<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrgstructSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orgstructs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orgstruct-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Orgstruct', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_orgstr',
            'kod_orgstr',
            'name_orgstr',
            'id_fun',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
