<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BudgetGroup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มงบประมาณ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-group-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'desc',
            'year',
            'total',
            'used',
            'remain',
            'parent',
            'parent_id',
            'manage',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
