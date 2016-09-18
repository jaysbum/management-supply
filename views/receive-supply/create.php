<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReceiveSupply */

$this->title = 'Create Receive Supply';
$this->params['breadcrumbs'][] = ['label' => 'Receive Supplies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receive-supply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
