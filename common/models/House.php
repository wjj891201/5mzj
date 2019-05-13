<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

class House extends ActiveRecord
{

    public $price1, $to_price1;
    public $type_hab, $type_hall, $type_toilet;
    public $house_owner, $mob_phonel;
    public $lab;
    public $is_mortgage;
    public $recommend, $user_grade, $high_quality;

    public static function tableName()
    {
        return "{{%house}}";
    }

    public function attributeLabels()
    {
        return [
            'hou_name' => '标题',
            'hou_building' => '栋',
            'hou_cell' => '单元',
            'hou_room' => '室',
            'hou_area' => '房屋面积',
            'to_price1' => '售价',
            'price1' => '单价',
            'type_hab' => '室',
            'type_hall' => '厅',
            'type_toilet' => '卫',
            'hou_turn' => '朝向',
            'hou_fix_state' => '装修类型',
            'hou_usetype' => '房屋类别',
            'hou_floor' => '所在楼层',
            'hou_floor_acc' => '总楼层',
            'house_owner' => '称呼',
            'mob_phonel' => '手机号',
            'hou_remark' => '描述',
            'lab' => '房源标签',
            'user_grade' => '推荐指数'
        ];
    }

    public function rules()
    {
        return [
                [['hou_name', 'hou_building', 'hou_cell', 'hou_room', 'type_hab', 'type_hall', 'type_toilet', 'hou_turn', 'hou_fix_state', 'hou_usetype'], 'required', 'message' => '{attribute}为必填项'],
                [['hou_area', 'to_price1', 'price1'], 'required', 'message' => '{attribute}为必填项'],
                [['hou_floor', 'hou_floor_acc', 'house_owner', 'mob_phonel', 'hou_remark', 'lab'], 'required', 'message' => '{attribute}为必填项'],
                [['user_grade'], 'required', 'message' => '{attribute}为必填项'],
                ['cre_time', 'default', 'value' => date('Y-m-d H:i:s')],
                [['is_mortgage', 'recommend', 'high_quality'], 'safe']
        ];
    }

    /**
     * 添加方法
     * @param type $data
     * @return boolean
     */
    public function add($data)
    {
        if ($this->load($data) && $this->save())
        {
            $house_id = Yii::$app->db->getLastInsertID();
            Yii::$app->db->createCommand()->insert("{{%house_sales}}", ['house_id' => $house_id, 'price1' => $this->price1, 'to_price1' => $this->to_price1, 'cre_time' => date('Y-m-d H:i:s')])->execute();
            $house_sales_id = Yii::$app->db->getLastInsertID();
            var_dump($house_sales_id);
            exit;
            return true;
        }
        return false;
    }

}
