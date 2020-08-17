<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\tables\Dmu */

$this->title = 'Создать DMU';
$this->params['breadcrumbs'][] = ['label' => 'DMU', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dmu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
