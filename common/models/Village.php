<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;

class Village extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%village}}";
    }

    public function attributeLabels()
    {
        return [
            'vill_name' => '小区名称',
            'vill_add' => '详细地址',
            'prop_comp' => '物业公司',
            'vill_region' => '所属区域',
            'vill_street' => '所在街道',
            'plate_id' => '所在板块',
            'build_age' => '建筑年代',
            'to_hou_holds' => '总户数',
            'to_building' => '总楼栋数',
            'park_space' => '停车位',
            'green_rate' => '绿化率',
            'plot_rate' => '容积率',
            'vill_cost' => '物业费'
        ];
    }

    public function rules()
    {
        return [
                [['vill_name', 'vill_add', 'prop_comp', 'build_age', 'to_hou_holds', 'to_building', 'park_space', 'green_rate', 'plot_rate', 'vill_cost'], 'required', 'message' => '{attribute}为必填项'],
                [['vill_region', 'vill_street', 'plate_id'], 'required', 'message' => '{attribute}为必选项'],
                ['vill_name', 'filter', 'filter' => 'trim'],
                ['vill_name', 'unique', 'message' => '{attribute}已存在'],
                ['cre_time', 'default', 'value' => date('Y-m-d H:i:s')],
        ];
    }

    public function add($data)
    {
        if ($this->load($data) && $this->save())
        {
            return true;
        }
        return false;
    }

}
