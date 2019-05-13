<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class DicItem extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%dic_item}}";
    }

    /**
     * 获取字典数据
     */
    public static function getDicItem($where = [])
    {
        $dicItem = self::find()->where($where)->all();
        $dicItem = ArrayHelper::toArray($dicItem);
        $dicItem = ArrayHelper::map($dicItem, 'id', 'name');
        $options = ['' => '请选择'];
        foreach ($dicItem as $key => $vo)
        {
            $options[$key] = $vo;
        }
        $dicItem = $options;
        return $dicItem;
    }

}
