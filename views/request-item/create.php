<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RequestItem */

$this->title = 'สร้างรายการ';
$this->params['breadcrumbs'][] = ['label' => 'รายการพัสดุตามใบแจ้ง', 'url' => ['index','rid'=>$_GET['rid']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
