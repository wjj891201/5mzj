<?php

namespace common\models;

use yii\db\ActiveRecord;

class HouseSales extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%house_sales}}";
    }

}
