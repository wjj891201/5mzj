<?php

namespace backend\models;

use yii\db\ActiveRecord;

class UserRoleRelation extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%user_role}}";
    }

}
