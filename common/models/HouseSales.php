<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\Url;

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

    /**
     * 获取状态的操作
     */
    public static function getStateOperate($status, $house_id, $controller)
    {
        switch ($status)
        {
            case 103:
                $str = "<a style='text-decoration:none' class='ml-5' onclick=\"house_operate('核实','" . Url::to([$controller . '/change-state', 'id' => $house_id, 'next_state' => 100]) . "')\" href=\"javascript:;\" title='核实'><i class='Hui-iconfont'>&#xe6e1;</i></a>";
                break;
            case 104:
                $str = '已核实';
                break;
            case 100:
                $str = "<a style='text-decoration:none' class='ml-5' onclick=\"house_operate('发布','" . Url::to([$controller . '/change-state', 'id' => $house_id, 'next_state' => 101]) . "')\" href=\"javascript:;\" title='发布'><i class='Hui-iconfont'>&#xe603;</i></a>";
                break;
            case 101:
                $str = "<a style='text-decoration:none' class='ml-5' onclick=\"house_operate('下架','" . Url::to([$controller . '/change-state', 'id' => $house_id, 'next_state' => 102]) . "')\" href=\"javascript:;\" title='下架'><i class='Hui-iconfont'>&#xe6de;</i></a>";
                break;
            case 102:
                $str = "<a style='text-decoration:none' class='ml-5' onclick=\"house_operate('上架','" . Url::to([$controller . '/change-state', 'id' => $house_id, 'next_state' => 103]) . "')\" href=\"javascript:;\" title='上架'><i class='Hui-iconfont'>&#xe6dc;</i></a>";
                break;
            case 105:
                $str = '不匹配';
                break;
        }
        return $str;
    }

}
