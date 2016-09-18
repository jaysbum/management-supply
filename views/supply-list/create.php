<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SupplyList */

$this->title = 'บันทึกรายการพัสดุ';
$this->params['breadcrumbs'][] = ['label' => 'รายการความต้องการพัสดุ', 'url' => ['index','gid'=>$_GET['gid']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supply-list-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
