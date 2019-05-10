<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Area extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%area}}";
    }

    public static function getOption($where = [])
    {
        $allArea = self::find()->where($where)->all();
        $allArea = ArrayHelper::toArray($allArea);
        $allArea = ArrayHelper::map($allArea, 'areaID', 'area');
        $options = ['' => '请选择'];
        foreach ($allArea as $key => $vo)
        {
            $options[$key] = $vo;
        }
        $allArea = $options;
        return $allArea;
    }

}
