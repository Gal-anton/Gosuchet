<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\tables\OrgFunction */

$this->title = 'Создать функцию';
$this->params['breadcrumbs'][] = ['label' => 'Функции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-function-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
