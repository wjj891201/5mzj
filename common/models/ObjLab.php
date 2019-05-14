<?php

namespace common\models;

use yii\db\ActiveRecord;

class ObjLab extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%obj_lab}}";
    }

}
