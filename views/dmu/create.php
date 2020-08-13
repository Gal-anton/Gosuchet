<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dmu */

$this->title = 'Create Dmu';
$this->params['breadcrumbs'][] = ['label' => 'Dmus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dmu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
