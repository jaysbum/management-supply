<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SupplyList */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Supply Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supply-list-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id, 'gid' => $_GET['gid']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id , 'gid' => $_GET['gid']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณต้องการที่จะลบข้อมูล?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'group_id',
            'name:ntext',
            'nsn',
            'unit_issue',
            'gpsc',
            'price',
            'quantity',
            //'total',
            'real_price',
            'real_quantity',
            //'real_total',
            //'margin_total',
            //'status',
            'remark:ntext',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
