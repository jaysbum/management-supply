<?php

namespace app\models;

use Yii;
use app\models\SupplyList;
/**
 * This is the model class for table "budget_group".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property integer $year
 * @property string $total
 * @property string $used
 * @property string $remain
 * @property integer $parent
 * @property integer $parent_id
 * @property integer $manage
 * @property integer $created_at
 * @property integer $updated_at
 */
class BudgetGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'budget_group';
    }
    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }
    public function rules()
    {
        return [
            [['name', 'year', 'total', 'parent', 'manage'], 'required'],
            [['year', 'parent', 'parent_id', 'manage', 'created_at', 'updated_at'], 'integer'],
            [['total'], 'number'],
            [['name', 'desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อกลุ่มงบประมาณ',
            'desc' => 'คำอธิบาย',
            'year' => 'ปีงบประมาณ',
            'total' => 'วงเงินที่ได้รับ',
            'parent' => 'ตัวเลือกกลุ่มหลัก',
            'parent_id' => 'ชื่อกลุ่มหลัก',
            'manage' => 'บริหารงบประมาณ',
            'created_at' => 'วันที่บันทึก',
            'updated_at' => 'วันที่ปรับปรุง',
        ];
    }

    public function getBudgetuse(){
      if($this->parent):
          $ids = BudgetGroup::find()->where('parent_id = '.$this->parent_id)->andWhere('parent = 0')->select(['id']);
          $total = SupplyList::find()->where(['group_id' => $ids])->sum('price * quantity');
      else:
          $total = SupplyList::find()->where(['group_id' => $this->id])->sum('price * quantity');
      endif;
      return (!empty($total))?$total:0;
    }
    public function getCount(){
      if($this->parent):
          $ids = BudgetGroup::find()->where('parent_id = '.$this->parent_id)->andWhere('parent = 0')->select(['id']);
          $total = SupplyList::find()->where(['group_id' => $ids])->count('id');
      else:
          $total = SupplyList::find()->where(['group_id' => $this->id])->count('id');
      endif;
      return (!empty($total))?$total:0;
    }
    public function getBudgetremain(){
      return $this->total - $this->getBudgetuse();
    }
    public function getLimit(){
      $sum = BudgetGroup::find()->where('parent_id = '.$this->parent_id)->andWhere('parent = 0')->sum('total');
      $total = BudgetGroup::findOne($this->parent_id)->total;
      return $total - $sum;
    }
    public function getSum(){
      return BudgetGroup::find()->where('parent_id = '.$this->parent_id)->andWhere('parent = 0')->sum('total');
    }
}
