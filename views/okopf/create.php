<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\tables\Okopf */

$this->title = 'Добавить ОКОПФ';
$this->params['breadcrumbs'][] = ['label' => 'ОКОПФ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="okopf-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
