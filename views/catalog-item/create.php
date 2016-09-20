<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CatalogItem */

$this->title = 'กำหนดหมายเลขพัสดุใหม่';
$this->params['breadcrumbs'][] = ['label' => 'รายการหมายเลขพัสดุ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-item-create">

 <h1><?= Html::encode($this->title) ?></h1>
 <?= $this->render('_form', [
 'model' => $model
 ]) ?>

</div>
