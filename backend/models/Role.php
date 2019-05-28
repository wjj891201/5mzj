<?php

namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

class Role extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%role}}";
    }

    public function attributeLabels()
    {
        return [
            'name' => '角色名称'
        ];
    }

    public function rules()
    {
        return [
                ['name', 'required', 'message' => '{attribute}不能为空', 'on' => ['add', 'modify']],
                ['name', 'unique', 'message' => '{attribute}已存在', 'on' => ['add', 'modify']],
        ];
    }

    public static function getData()
    {
        $all_role = self::find()->asArray()->all();
        return $all_role;
    }

    public function add($data)
    {
        $this->scenario = 'add';
        $this->created_time = date('Y-m-d H:i:s');
        if ($this->load($data) && $this->save())
        {
            $id = Yii::$app->db->getLastInsertID();
            if (isset($data['access_ids']) && !empty($data['access_ids']))
            {
                foreach ($data['access_ids'] as $vo)
                {
                    Yii::$app->db->createCommand()->insert("{{%role_access}}", ['role_id' => $id, 'access_id' => $vo, 'created_time' => date('Y-m-d H:i:s')])->execute();
                }
            }
            return true;
        }
        return false;
    }

    public function modify($data)
    {
        $this->scenario = 'modify';
        $this->updated_time = date('Y-m-d H:i:s');
        if ($this->load($data) && $this->save())
        {
            $id = $this->id;
            $have_access = RoleAccessRelation::find()->select('access_id')->where(['role_id' => $id])->asArray()->column();
            if (isset($data['access_ids']) && !empty($data['access_ids']))
            {
                $collection = array_intersect($have_access, $data['access_ids']);
                var_dump($have_access, $data['access_ids']);
                exit;
            }
            return true;
        }
        return false;
    }

}
