<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReceiveItem */

$this->title = 'เพิ่มรายการพัสดุที่ได้รับตามใบ ทอ.74 ที่ '.\app\models\ReceiveSupply::findOne($_GET['rid'])->doc_num."/".\app\models\ReceiveSupply::findOne($_GET['rid'])->year;
$this->params['breadcrumbs'][] = ['label' => 'รายการใบรับพัสดุ', 'url' => ['index','rid'=>$_GET['rid']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receive-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
