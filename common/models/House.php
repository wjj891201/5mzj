<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

class House extends ActiveRecord
{

    public $vill_name;
    public $price1, $to_price1, $is_mortgage, $recommend, $user_grade, $high_quality;
    public $type_hab, $type_hall, $type_toilet;
    public $house_owner, $mob_phone;
    public $lab;

    public static function tableName()
    {
        return "{{%house}}";
    }

    public function attributeLabels()
    {
        return [
            'hou_name' => '标题',
            'vill_name' => '小区名称',
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
            'mob_phone' => '手机号',
            'hou_remark' => '描述',
            'lab' => '房源标签',
            'user_grade' => '推荐指数'
        ];
    }

    public function rules()
    {
        return [
                [['hou_name', 'vill_name', 'hou_building', 'hou_cell', 'hou_room', 'type_hab', 'type_hall', 'type_toilet', 'hou_turn', 'hou_fix_state', 'hou_usetype'], 'required', 'message' => '{attribute}为必填项'],
                ['vill_name', 'validateVillName'],
                [['hou_area', 'to_price1', 'price1'], 'required', 'message' => '{attribute}为必填项'],
                [['hou_floor', 'hou_floor_acc', 'house_owner', 'mob_phone', 'hou_remark', 'lab'], 'required', 'message' => '{attribute}为必填项'],
                [['user_grade'], 'required', 'message' => '{attribute}为必填项'],
                ['cre_time', 'default', 'value' => date('Y-m-d H:i:s')],
                [['is_mortgage', 'recommend', 'high_quality'], 'safe']
        ];
    }

    /**
     * 自定义验证方法（小区合法性）
     * @param type $attribute
     * @param type $params
     */
    public function validateVillName($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $data = Village::find()->where('vill_name = :vill_name', [":vill_name" => $this->vill_name])->one();
            if (is_null($data))
            {
                $this->addError($attribute, "小区不存在，请至小区信息管理中添加");
            }
            else
            {
                $this->vill_id = $data['id'];
            }
        }
    }

    /**
     * 二手房添加方法
     * @param type $data
     * @return boolean
     */
    public function add($data)
    {
        if ($this->load($data) && $this->save())
        {
            $house_id = Yii::$app->db->getLastInsertID();
            # 房源出售信息
            $is_recomm = self::handRecomm($this->recommend, $this->high_quality);
            Yii::$app->db->createCommand()->insert("{{%house_sales}}", ['house_id' => $house_id, 'sales_type' => 100, 'is_mortgage' => $this->is_mortgage, 'price1' => $this->price1, 'to_price1' => $this->to_price1, 'is_recomm' => $is_recomm, 'user_grade' => $this->user_grade, 'cre_time' => date('Y-m-d H:i:s')])->execute();
            $house_sales_id = Yii::$app->db->getLastInsertID();
            # 房源出售人信息
            Yii::$app->db->createCommand()->insert("{{%house_sal_owner}}", ['house_sales_id' => $house_sales_id, 'house_id' => $house_id, 'mob_phone' => $this->mob_phone, 'house_owner' => $this->house_owner, 'cre_time' => date('Y-m-d H:i:s')])->execute();
            # 户型
            Yii::$app->db->createCommand()->insert("{{%house_type}}", ['type_hab' => $this->type_hab, 'type_hall' => $this->type_hall, 'type_toilet' => $this->type_toilet, 'cover_area' => $this->hou_area])->execute();
            $house_type_id = Yii::$app->db->getLastInsertID();
            self::updateAll(['house_type_id' => $house_type_id], ['id' => $house_id]);
            # 对象标签
            $temp = [];
            foreach ($this->lab as $key => $vo)
            {
                $temp[$key] = ['tab_id' => $house_sales_id, 'obj_lab' => $vo, 'cre_time' => date('Y-m-d H:i:s')];
            }
            Yii::$app->db->createCommand()->batchInsert("{{%obj_lab}}", ['tab_id', 'obj_lab', 'cre_time'], $temp)->execute();
            return true;
        }
        return false;
    }

    /**
     * 二手房编辑方法
     * @param type $data
     * @return boolean
     */
    public function edit($data)
    {
        if ($this->load($data) && $this->save())
        {
            $house_id = $this->id;
            # 房源出售信息
            $is_recomm = self::handRecomm($this->recommend, $this->high_quality);
            Yii::$app->db->createCommand()->update("{{%house_sales}}", ['is_mortgage' => $this->is_mortgage, 'price1' => $this->price1, 'to_price1' => $this->to_price1, 'is_recomm' => $is_recomm, 'user_grade' => $this->user_grade, 'mod_time' => date('Y-m-d H:i:s')], ['house_id' => $house_id])->execute();
            # 房源出售人信息
            Yii::$app->db->createCommand()->update("{{%house_sal_owner}}", ['mob_phone' => $this->mob_phone, 'house_owner' => $this->house_owner], ['house_id' => $house_id])->execute();
            # 户型
            Yii::$app->db->createCommand()->update("{{%house_type}}", ['type_hab' => $this->type_hab, 'type_hall' => $this->type_hall, 'type_toilet' => $this->type_toilet, 'cover_area' => $this->hou_area], ['id' => $this->house_type_id])->execute();
            # 对象标签
            $house_sales_id = HouseSales::find()->select('id')->where(['house_id' => $house_id])->scalar();
            ObjLab::deleteAll(['tab_id' => $house_sales_id]);
            $temp = [];
            foreach ($this->lab as $key => $vo)
            {
                $temp[$key] = ['tab_id' => $house_sales_id, 'obj_lab' => $vo, 'cre_time' => date('Y-m-d H:i:s')];
            }
            Yii::$app->db->createCommand()->batchInsert("{{%obj_lab}}", ['tab_id', 'obj_lab', 'cre_time'], $temp)->execute();
            return true;
        }
        return false;
    }

    public static function handRecomm($recommend, $high_quality)
    {
        $is_recomm = 0;
        if ($recommend == 1 && $high_quality == 1)
        {
            $is_recomm = 3;
        }
        elseif ($recommend == 1 && $high_quality == 0)
        {
            $is_recomm = 1;
        }
        elseif ($recommend == 0 && $high_quality == 1)
        {
            $is_recomm = 2;
        }
        return $is_recomm;
    }

    /**
     * 获取小区信息
     */
    public function getVillage()
    {
        return $this->hasOne(Village::className(), ['id' => 'vill_id']);
    }

    /**
     * 获取房源出售信息
     */
    public function getHouseSales()
    {
        return $this->hasOne(HouseSales::className(), ['house_id' => 'id']);
    }

    /**
     * 获取户型
     */
    public function getHouseType()
    {
        return $this->hasOne(HouseType::className(), ['id' => 'house_type_id']);
    }

    /**
     * 获取房源出售人信息
     */
    public function getHouseSalOwner()
    {
        return $this->hasOne(HouseSalOwner::className(), ['house_id' => 'id']);
    }

}
