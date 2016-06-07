<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property integer $id
 * @property integer $floor
 * @property integer $room_number
 * @property integer $has_conditioner
 * @property integer $has_tv
 * @property integer $has_phone
 * @property string $available_from
 * @property string $price_per_day
 * @property string $description
 *
 * @property Reservation[] $reservations
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['floor', 'room_number', 'has_conditioner', 'has_tv', 'has_phone', 'available_from'], 'required'],
            [['floor', 'room_number', 'has_conditioner', 'has_tv', 'has_phone'], 'integer'],
            [['available_from'], 'safe'],
            [['price_per_day'], 'number'],
            [['description'], 'string'],
            [['file_image'], 'file']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'floor' => '楼层',
            'room_number' => '房间号',
            'has_conditioner' => '空调',
            'has_tv' => '电视',
            'has_phone' => '电话',
            'available_from' => '可用时间',
            'price_per_day' => '租金',
            'description' => '描述',
            'file_image' => '图片'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(Reservation::className(), ['room_id' => 'id']);
    }

    public function getLastReservation()
    {
        return $this->hasOne(Reservation::className(), ['room_id' => 'id'])->orderBy('id');
    }

    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['id' => 'customer_id'])->via('reservations');
    }
}
