<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Okato */

$this->title = 'Обновить ОКАТО:' . $model->kod_okato;
$this->params['breadcrumbs'][] = ['label' => 'ОКАТО', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kod_okato, 'url' => ['view', 'id' => $model->id_okato]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="okato-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
