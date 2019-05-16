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
    public static function getDicItem($code = '', $mark = true)
    {
        $id = self::find()->select('id')->where(['code' => $code])->scalar();
        $dicItem = self::find()->where(['p_id' => $id])->all();
        $dicItem = ArrayHelper::toArray($dicItem);
        $dicItem = ArrayHelper::map($dicItem, 'code', 'name');
        if ($mark)
        {
            $options = ['' => '请选择'];
        }
        foreach ($dicItem as $key => $vo)
        {
            $options[$key] = $vo;
        }
        $dicItem = $options;
        return $dicItem;
    }

}
