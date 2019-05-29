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
        $all_role = self::find()->asArray()->orderBy(['created_time' => SORT_DESC])->all();
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
                // 交集
                $collection = array_intersect($have_access, $data['access_ids']);
                // 差集
                $diff_1 = array_diff($have_access, $collection);
                $diff_2 = array_diff($data['access_ids'], $collection);
                // $diff_1删除 $diff_2添加
                if (!empty($diff_1))
                {
                    RoleAccessRelation::deleteAll(['AND', ['role_id' => $id], ['IN', 'access_id', $diff_1]]);
                }
                if (!empty($diff_2))
                {
                    $temp = [];
                    foreach ($diff_2 as $key => $vo)
                    {
                        $temp[$key] = ['role_id' => $id, 'access_id' => $vo, 'created_time' => date('Y-m-d H:i:s')];
                    }
                    Yii::$app->db->createCommand()->batchInsert("{{%role_access}}", ['role_id', 'access_id', 'created_time'], $temp)->execute();
                }
            }
            return true;
        }
        return false;
    }

}
