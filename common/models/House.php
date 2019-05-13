<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class House extends ActiveRecord
{

    public $price1, $to_price1;
    public $type_hab, $type_hall, $type_toilet;
    public $house_owner, $mob_phonel;
    public $lab;
    public $is_mortgage;
    public $recommend, $user_grade, $high_quality;

    public static function tableName()
    {
        return "{{%house}}";
    }

}
