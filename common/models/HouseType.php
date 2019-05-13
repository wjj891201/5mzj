<?php

namespace common\models;

use yii\db\ActiveRecord;

class HouseType extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%house_type}}";
    }

}
