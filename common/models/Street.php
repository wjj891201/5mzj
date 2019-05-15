<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Street extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%street}}";
    }

    public static function getOption($where = [])
    {
        $allStreet = self::find()->where($where)->all();
        $allStreet = ArrayHelper::toArray($allStreet);
        $allStreet = ArrayHelper::map($allStreet, 'streetID', 'street');
        $options = ['' => '请选择'];
        foreach ($allStreet as $key => $vo)
        {
            $options[$key] = $vo;
        }
        $allStreet = $options;
        return $allStreet;
    }

}
