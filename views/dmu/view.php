<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Dmu */

$this->title = $model->dmu_dmu;
$this->params['breadcrumbs'][] = ['label' => 'DMU', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dmu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a('Построить график', ['post/index', 'id_dmu' => $model->id_dmu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_dmu], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_dmu',
            'dmu_dmu',
            //'kod_is',
            ['attribute' => 'name_fun', 'label' => 'Функция организации',
                'value' => function ($model) {
                    return $model->fun->kod_fun . " " . $model->fun->name_fun;
                },],
            ['attribute' => 'name_mod', 'label' => 'Модель',
                'value' => function ($model) {
                    return $model->mod->kod_mod . " " . $model->mod->name_mod;
                },],
            ['attribute' => 'input', 'label' => 'Входные данные',
                'value' => function ($model) {
                    return $model->input->kod_input . " " . $model->input->name_input;
                },],
            'sum_input',
            ['attribute' => 'output', 'label' => 'Результат',
                'value' => function ($model) {
                    return $model->output->kod_output . " " . $model->output->name_output;
                },],
            'sum_output',
            'efficency',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
