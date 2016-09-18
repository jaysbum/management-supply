<?php

namespace app\models;

use Yii;
use app\models\RequestItem;
/**
 * This is the model class for table "request_supply".
 *
 * @property integer $id
 * @property integer $doc_num
 * @property string $doc_date
 * @property integer $year
 * @property integer $status
 * @property string $remark
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property RequestItem[] $requestItems
 */
class RequestSupply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_supply';
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
            [['doc_num', 'doc_date', 'year'], 'required'],
            [['doc_num', 'year', 'status', 'created_at', 'updated_at'], 'integer'],
            [['doc_date'], 'safe'],
            [['remark'], 'string'],
            [['doc_num', 'year'], 'unique', 'targetAttribute' => ['doc_num', 'year'], 'message' => 'ข้อมูลซ้ำกัน'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doc_num' => 'เลขที่เอกสาร',
            'doc_date' => 'วันที่เอกสาร',
            'year' => 'ปีงบประมาณ',
            'status' => 'สถานะ',
            'remark' => 'หมายเหตุ',
            'created_at' => 'วันที่สร้าง',
            'updated_at' => 'วันที่ปรับปรุง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestItems()
    {
        return $this->hasMany(RequestItem::className(), ['request_id' => 'id']);
    }
    public function getCount()
    {
        return RequestItem::find()->where(['request_id'=>$this->id])->count('id');
    }
    public function getTotal()
    {
        return RequestItem::find()->where(['request_id'=>$this->id])->sum('quantity * price');
    }
    public function getPayment()
    {
        $total = \app\models\BudgetPayment::find()->where(['request_id'=>$this->id])->sum('total');
        return (!empty($total))?$total:0;
    }
    public function getRemain()
    {
        return $this->total - $this->payment;
    }
    public function getPaystatus()
    {
        return ($this->total == $this->getPayment());
    }
}
