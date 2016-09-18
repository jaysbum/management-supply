<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "budget_payment".
 *
 * @property integer $id
 * @property integer $request_id
 * @property integer $month
 * @property integer $year
 * @property string $total
 * @property string $payment_date
 * @property string $remark
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property RequestSupply $request
 */
class BudgetPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'budget_payment';
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
            [['request_id', 'month', 'year','total','payment_date'], 'required'],
            [['request_id', 'month', 'year', 'created_at', 'updated_at'], 'integer'],
            [['total'], 'number'],
            [['payment_date'], 'safe'],
            [['remark'], 'string'],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestSupply::className(), 'targetAttribute' => ['request_id' => 'id']],
            [['request_id','month', 'year'], 'unique', 'targetAttribute' => ['request_id','month', 'year'], 'message' => 'ข้อมูลซ้ำกัน'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'รหัสใบแจ้งความต้องการ',
            'month' => 'เดือน',
            'year' => 'ปี',
            'total' => 'วงเงิน',
            'payment_date' => 'วันที่เบิกจ่าย',
            'remark' => 'หมายเหตุ',
            'created_at' => 'วันที่สร้างรายการ',
            'updated_at' => 'วันที่ปรับปรุงรายการ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(RequestSupply::className(), ['id' => 'request_id']);
    }
    public function getMonthname()
    {
        switch ($this->month) {
          case 1:$monthname="ต.ค.";break;
          case 2:$monthname="พ.ย.";break;
          case 3:$monthname="ธ.ค.";break;
          case 4:$monthname="ม.ค.";break;
          case 5:$monthname="ก.พ.";break;
          case 6:$monthname="มี.ค.";break;
          case 7:$monthname="เม.ย.";break;
          case 8:$monthname="พ.ค.";break;
          case 9:$monthname="มิ.ย.";break;
          case 10:$monthname="ก.ค.";break;
          case 11:$monthname="ส.ค.";break;
          case 12:$monthname="ก.ย.";break;
          default:break;
        }
        return $monthname;
    }
    public function getQuarter()
    {
      return ceil($this->month/3);
    }
}
