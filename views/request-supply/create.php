<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RequestSupply */

$this->title = 'สร้างรายการแจ้งความต้องการ';
$this->params['breadcrumbs'][] = ['label' => 'รายการแจ้งความต้องการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-supply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
