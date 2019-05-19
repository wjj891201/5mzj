<?php

namespace common\models;

use yii\db\ActiveRecord;

class HouseSales extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%house_sales}}";
    }

    /**
     * 获取发布状态中文
     */
    public static function getHouPubState($status)
    {
        switch ($status)
        {
            case 103:
                $str = '<span class="btn btn-danger size-MINI radius">待核实</span>';
                break;
            case 104:
                $str = '已核实';
                break;
            case 100:
                $str = '<span class="btn btn-secondary size-MINI radius">待发布</span>';
                break;
            case 101:
                $str = '<span class="btn btn-success size-MINI radius">已发布</span>';
                break;
            case 102:
                $str = '<span class="btn btn-default size-MINI radius">已下架</span>';
                break;
            case 105:
                $str = '<span class="btn btn-warning size-MINI radius">不匹配</span>';
                break;
        }
        return $str;
    }

}
