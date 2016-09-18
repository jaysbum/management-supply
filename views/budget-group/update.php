<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BudgetGroup */

$this->title = 'แก้ไขกลุ่มงบประมาณ : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มงบประมาณ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="budget-group-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
