<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BudgetGroup */

$this->title = 'สร้างกลุ่มงบประมาณ';
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มงบประมาณ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-group-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
