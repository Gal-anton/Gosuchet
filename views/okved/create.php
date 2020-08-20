<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\tables\Okved */

$this->title = 'Добавить ОКВЭД';
$this->params['breadcrumbs'][] = ['label' => 'ОКВЭД', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="okved-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
