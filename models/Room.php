<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/6
 * Time: 16:21
 */

namespace app\models;


use yii\base\Model;

class Room extends Model
{
    public $floor;
    public $room_number;
    public $has_conditioner;
    public $has_tv;
    public $has_phone;
    public $available_from;
    public $price_per_day;
    public $description;

    public function attributeLabels()
    {
        return [
            'floor' => '楼层',
            'room_number' => '房间号',
            'has_condition' => '是否有空调',
            'has_tv' => '是否有电视',
            'has_phone' => '是否有电话',
            'available_from' => '可用时间',
            'price_per_day' => '价格(欧元/日)',
            'description' => '描述',
        ];
    }

    public function rules()
    {
        return [
            ['floor', 'integer', 'min' => 0],
            ['room_number', 'integer', 'min' => 0],
            [['has_conditioner', 'has_tv', 'has_phone'], 'integer', 'min' => 0, 'max' => 1],
            ['available_from', 'date', 'format' => 'php:Y-m-d'],
            ['price_per_day', 'number', 'min' => 0],
            ['description', 'string', 'max' => 500]
        ];
    }

}