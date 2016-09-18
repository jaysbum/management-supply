<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BudgetGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการกลุ่มงบประมาณ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-group-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('สร้างกลุ่มงบประมาณ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php if(Yii::$app->session->hasFlash('alert')):?>
      <?= \yii\bootstrap\Alert::widget([
      'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
      'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
      ])?>
    <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function ($model, $key, $index, $grid){
            $return = ($model['parent'] == 1)?array('class'=>'success','style'=>'font-weight: bold;'):array('class'=>'default');
            return $return;
        },
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            //'budgetuse',
            //'id',
            [ 'attribute'=>'name','label'=>'กลุ่มงบประมาณ',
              'value'=>function($data){
                return ($data['parent']==1)?$data['name']:' - '. $data['name'] .'</span>';
              },
              'format'=>'raw',
            ],
            [ 'attribute'=>'name',
              'value'=>function($data){
                return ($data['parent']==1)?'':'<a class="btn btn-danger btn-xs" href="'. yii\helpers\Url::to(['/supply-list','gid'=>$data['id']]) .'"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มรายการพัสดุ</a>';
              },
              'format'=>'raw',
              'filter'=>'',
              'contentOptions'=>['style'=>'width: 100px;'],
              'label'=>''
            ],
            //'desc',
            [ 'attribute'=>'year',
              'label'=>'ปีงบประมาณ',
              'contentOptions'=>['class'=>'text-center','style'=>'width: 100px;'],
              'filter' => range(0,99),
              /*'filterWidgetOptions'=>[
                'data'=>range(0,99),
                'options' => [
                  'prompt' => 'เลือกเลขที่ ...',
                ],
              ],*/
            ],
            [
              'attribute'=>'total',
              'value'=>function($data){
                if($data['parent']){
                  return number_format($data['total'],2)."<br><small><font color='red'>[". number_format($data['sum'],2) ."]</font></small>";
                }else{
                  return number_format($data['total'],2);
                }
              },
              'label'=>'วงเงินที่ได้รับ',
              'format'=>'raw',
              'filter'=>'',
              'contentOptions'=>['class'=>'text-right','style'=>'width: 100px;']
            ],
            ['attribute'=>'count','label'=>'จำนวนรายการ','contentOptions'=>['class'=>'text-right','style'=>'width: 80px;']],
            ['attribute'=>'budgetuse','label'=>'วงเงินที่ใช้ไป','format'=>'decimal','contentOptions'=>['class'=>'text-right','style'=>'width: 100px;']],
            [
              'attribute'=>'budgetremain',
              'label'=>'วงเงินคงเหลือ',
              'value'=>function($data){
                if($data['parent']){
                  return number_format($data['budgetremain'],2)."<br><small><font color='red'>[". number_format($data['limit'],2) ."]</font></small>";
                }else{
                  return number_format($data['budgetremain'],2);
                }
              },
              'format'=>'raw',
              'contentOptions'=>['class'=>'text-right','style'=>'width: 100px;']
            ],
            // 'used',
            // 'remain',
            // 'parent',
            // 'parent_id',
            // 'manage',
            // 'created_at',
            // 'updated_at',

            [
              'class' => 'kartik\grid\ActionColumn','template' => '{update} {delete}',
              'contentOptions'=>['noWrap' => true,'class'=>'text-center','style'=>'width: 100px;']],
        ],
    ]); ?>
</div>
