<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SupplyList */

$this->title = 'Update Supply List: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Supply Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="supply-list-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
