<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bujet */

$this->title = 'Create Bujet';
$this->params['breadcrumbs'][] = ['label' => 'Bujets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bujet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
