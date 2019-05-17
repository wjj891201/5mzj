<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Build extends ActiveRecord
{
    public $lab;

    public static function tableName()
    {
        return "{{%build}}";
    }

    /**
     * 楼盘添加方法
     * @param type $data
     * @return boolean
     */
    public function add($data)
    {
        if ($this->load($data) && $this->save())
        {

            return true;
        }
        return false;
    }

}
