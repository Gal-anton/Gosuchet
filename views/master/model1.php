<?php

use app\models\Master;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model Master */
/* @var $errors array */
/* @var $searchModel app\models\search\OrganisationSearch */
/* @var $orgData yii\data\ActiveDataProvider */

?>
    <h1>Мастер оценки</h1>
<?php echo $this->render('_modelView', ['model' => $model]); ?>

    <div class="master_data">
<?php
echo GridView::widget([
    'dataProvider' => $orgData,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'reg_num',
        'inn',
        //'full_name:ntext',
        'short_name',
        ['attribute' => 'tip_name', 'label' => 'Тип', 'value' => 'tip.name_tip'],
        'ppo',
        //'id_tip',
        //'id_vid',
        ['attribute' => 'vid_name', 'label' => 'Вид', 'value' => 'idV.name_vid'],
        ['attribute' => 'kod_okved', 'label' => 'ОКВЭД', 'value' => 'okved.kod_okved'],
        ['attribute' => 'kod_okato', 'label' => 'ОКАТО', 'value' => 'okato.kod_okato'],
        ['attribute' => 'kod_oktmo', 'label' => 'ОКТМО', 'value' => 'oktmo.kod_oktmo'],
        ['attribute' => 'kod_okfs', 'label' => 'ОКФС', 'value' => 'okfs.kod_okfs'],
        ['attribute' => 'kod_okopf', 'label' => 'ОКОПФ', 'value' => 'okopf.kod_okopf'],
        ['attribute' => 'owner_name', 'label' => 'Учредитель', 'value' => 'owner.reg_num'],
        //'id_okved',
        //'id_okato',
        //'id_oktmo',
        //'id_okfs',
        //'id_buj',
        //'id_okopf',
//        'id_owner',
        ['label' => '',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a('Выбрать', Url::to(['master/model?model=1&id_org=' . $data->id_org]));
            }],


    ],
]);
echo '<h2>Создание DMU для группировки организаций</h2>';
?>
    <div class="dmu-create">


        <?= $this->render('_formDMU', [
            'model' => $model,
        ]) ?>

    </div>
<?php //var_dump($errors);

