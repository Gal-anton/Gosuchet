<?php

/* @var $this yii\web\View */


use yii\helpers\Url;

$this->title = 'Справочники';
?>
<div class="site-index">
    <div class="body-content ">
        <div class="list-group" style="width: 50%">
            <a class="list-group-item list-group-item-action active">
                Выберите справочник
            </a>
            <a href="<?= Url::to(['organisation/']); ?>" class="list-group-item list-group-item-action">Справочник:
                "Организации"</a>
            <a href="<?= Url::to(['dmu/']); ?>" class="list-group-item list-group-item-action">Справочник: "DMU"</a>
            <a href="<?= Url::to(['okato/']); ?>" class="list-group-item list-group-item-action">Справочник:
                "Классификатор ОКАТО"</a>
            <a href="<?= Url::to(['okopf/']); ?>" class="list-group-item list-group-item-action">Справочник:
                "Классификатор ОКОПФ"</a>
            <a href="<?= Url::to(['oktmo/']); ?>" class="list-group-item list-group-item-action">Справочник:
                "Классификатор ОКТМО"</a>
            <a href="<?= Url::to(['okved/']); ?>" class="list-group-item list-group-item-action">Справочник:
                "Классификатор ОКВЭД"</a>
            <a href="<?= Url::to(['org-function/']); ?>" class="list-group-item list-group-item-action">Справочник: "Вид
                функции в ИСУГБ"</a>
            <a href="<?= Url::to(['orgstruct/']); ?>" class="list-group-item list-group-item-action">Справочник: "Тип
                структуры подсистемы ИСУГБ"</a>
            <a href="<?= Url::to(['tip-organisation/']); ?>" class="list-group-item list-group-item-action">Справочник:
                "Тип организации"</a>
            <a href="<?= Url::to(['vid-organisation/']); ?>" class="list-group-item list-group-item-action">Справочник:
                "Вид организации"</a>
            <a href="<?= Url::to(['vid-sob/']); ?>" class="list-group-item list-group-item-action">Справочник:
                "Классификатор ОКФС"</a>
            <a href="<?= Url::to(['inputs/']); ?>" class="list-group-item list-group-item-action">Справочник: "Вид
                ресурса(входа)"</a>
            <a href="<?= Url::to(['outputs/']); ?>" class="list-group-item list-group-item-action">Справочник: "Вид
                результата(выхода)"</a>
            <a href="<?= Url::to(['model/']); ?>" class="list-group-item list-group-item-action">Справочник: "Тип модели
                оценки"</a>
        </div>
    </div>
</div>
