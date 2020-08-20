<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Okved */

$this->title = 'Обновить ОКВЭД: ' . $model->kod_okved;
$this->params['breadcrumbs'][] = ['label' => 'ОКВЭД', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kod_okved, 'url' => ['view', 'id' => $model->id_okved]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="okved-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
