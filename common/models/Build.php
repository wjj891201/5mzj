<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;

class Build extends ActiveRecord
{

    public $lab;

    public static function tableName()
    {
        return "{{%build}}";
    }

    public function attributeLabels()
    {
        return [
            'build_name' => '楼盘名称',
            'build_add' => '楼盘地址',
            'build_years' => '产权年限',
            'build_area' => '建筑面积',
            'comp_name' => '开发商',
            'comp_lman' => '开发商联系人',
            'comp_tel' => '联系电话',
            'build_usetype' => '用途类型',
            'build_str' => '房屋结构类别',
            'build_type' => '建筑类别',
            'hou_fix_state' => '交付标准',
            'lab' => '楼盘标签',
            'build_remark' => '楼盘简介'
        ];
    }

    public function rules()
    {
        return [
                [
                    [
                    'build_name', 'build_add', 'build_years', 'build_area', 'comp_name', 'comp_lman', 'comp_tel',
                    'build_usetype', 'build_str', 'build_type', 'hou_fix_state', 'lab', 'build_remark'
                ],
                'required', 'message' => '{attribute}为必填项'
            ],
        ];
    }

    /**
     * 楼盘添加方法
     * @param type $data
     * @return boolean
     */
    public function add($data)
    {
        $this->cre_time = date('Y-m-d H:i:s');
        if ($this->load($data) && $this->save())
        {
            $build_id = Yii::$app->db->getLastInsertID();
            # 对象标签
            $temp = [];
            foreach ($this->lab as $key => $vo)
            {
                $temp[$key] = ['obj_type' => 100, 'tab_id' => $build_id, 'obj_lab' => $vo, 'cre_time' => date('Y-m-d H:i:s')];
            }
            Yii::$app->db->createCommand()->batchInsert("{{%obj_lab}}", ['obj_type', 'tab_id', 'obj_lab', 'cre_time'], $temp)->execute();
            return true;
        }
        return false;
    }

}
