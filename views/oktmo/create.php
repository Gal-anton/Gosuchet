<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Oktmo */

$this->title = 'Create Oktmo';
$this->params['breadcrumbs'][] = ['label' => 'Oktmos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oktmo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
