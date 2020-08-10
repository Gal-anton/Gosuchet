<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Okato */

$this->title = 'Create Okato';
$this->params['breadcrumbs'][] = ['label' => 'Okatos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="okato-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
