<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\tables\Okato */

$this->title = 'Добавить ОКАТО';
$this->params['breadcrumbs'][] = ['label' => 'ОКАТО', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="okato-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
