<?php

namespace backend\models;

use yii\db\ActiveRecord;

class BackendUserRoleRelation extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%backend_user_role}}";
    }

}
