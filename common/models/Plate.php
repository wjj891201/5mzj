<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Plate extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%plate}}";
    }

    public static function getOption($where = [])
    {
        $allPlate = self::find()->where($where)->all();
        $allPlate = ArrayHelper::toArray($allPlate);
        $allPlate = ArrayHelper::map($allPlate, 'id', 'plate_name');
        $options = ['' => '请选择'];
        foreach ($allPlate as $key => $vo)
        {
            $options[$key] = $vo;
        }
        $allPlate = $options;
        return $allPlate;
    }

}
