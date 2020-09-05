<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\tables\DataReport */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Data Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
