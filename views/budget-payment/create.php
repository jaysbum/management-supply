<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BudgetPayment */

$this->title = 'เพิ่มรายการเบิกจ่าย';
$this->params['breadcrumbs'][] = ['label' => 'รายการเบิกจ่ายงบประมาณ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
