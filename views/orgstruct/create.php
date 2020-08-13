<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Orgstruct */

$this->title = 'Create Orgstruct';
$this->params['breadcrumbs'][] = ['label' => 'Orgstructs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orgstruct-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
