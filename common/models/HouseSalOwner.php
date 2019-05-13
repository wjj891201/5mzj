<?php

namespace common\models;

use yii\db\ActiveRecord;

class HouseSalOwner extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%house_sal_owner}}";
    }

}
