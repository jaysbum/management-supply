<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CatalogItem */

$this->title = 'แก้ไขรายการ: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'รายการพัสดุ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="catalog-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
