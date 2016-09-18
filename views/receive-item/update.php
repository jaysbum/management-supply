<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReceiveItem */

$this->title = 'Update Receive Item: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Receive Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="receive-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
