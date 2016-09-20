<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CatalogGroup */

$this->title = 'สร้างกลุ่มพัสดุ';
$this->params['breadcrumbs'][] = ['label' => 'รายการกลุ่มพัสดุ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
