<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;

class BuildHoutype extends ActiveRecord
{

    public $build_name, $lab;

    public static function tableName()
    {
        return "{{%build_houtype}}";
    }

    public function attributeLabels()
    {
        return [
            'build_name' => '楼盘名称',
            'type_name' => '户型名称',
            'type_cate' => '户型类别',
            'cover_area' => '建面',
            'average_price' => '参考均价',
            'total_price' => '参考总价',
            'type_hab' => '室',
            'type_hall' => '厅',
            'type_toilet' => '卫',
            'type_kit' => '厨',
            'lab' => '户型标签',
            'type_remark' => '户型简介',
            'type_dis' => '户型楼栋分布'
        ];
    }

    public function rules()
    {
        return [
                [['build_name', 'type_name', 'cover_area', 'average_price', 'total_price', 'type_hab', 'type_hall', 'type_toilet', 'type_kit', 'lab', 'type_remark', 'type_dis'], 'required', 'message' => '{attribute}为必填项'],
                [['type_cate'], 'required', 'message' => '{attribute}为必选项'],
                [['build_name', 'type_name'], 'filter', 'filter' => 'trim'],
                [['cover_area', 'type_hab', 'type_hall', 'type_toilet', 'type_kit'], 'number', 'message' => '请填写数字'],
                ['build_name', 'validateBuildName']
        ];
    }

    /**
     * 自定义验证方法（楼盘合法性）
     * @param type $attribute
     * @param type $params
     */
    public function validateBuildName($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $data = Build::find()->where('build_name = :build_name', [":build_name" => $this->build_name])->one();
            if (is_null($data))
            {
                $this->addError($attribute, "楼盘不存在，请至楼盘信息管理中添加");
            }
            else
            {
                $this->build_id = $data['id'];
            }
        }
    }

    public function add($data)
    {
        $this->cre_time = date('Y-m-d H:i:s');
        if ($this->load($data) && $this->save())
        {
            $build_houtype_id = Yii::$app->db->getLastInsertID();
            # 对象标签
            $temp = [];
            foreach ($this->lab as $key => $vo)
            {
                $temp[$key] = ['obj_type' => 103, 'tab_id' => $build_houtype_id, 'obj_lab' => $vo, 'cre_time' => date('Y-m-d H:i:s')];
            }
            Yii::$app->db->createCommand()->batchInsert("{{%obj_lab}}", ['obj_type', 'tab_id', 'obj_lab', 'cre_time'], $temp)->execute();
            return true;
        }
        return false;
    }

    public function edit($data)
    {
        $this->mod_time = date('Y-m-d H:i:s');
        if ($this->load($data) && $this->save())
        {
            # 对象标签
            $build_houtype_id = $this->id;
            ObjLab::deleteAll(['obj_type' => 103, 'tab_id' => $build_houtype_id]);
            $temp = [];
            foreach ($this->lab as $key => $vo)
            {
                $temp[$key] = ['obj_type' => 103, 'tab_id' => $build_houtype_id, 'obj_lab' => $vo, 'cre_time' => date('Y-m-d H:i:s')];
            }
            Yii::$app->db->createCommand()->batchInsert("{{%obj_lab}}", ['obj_type', 'tab_id', 'obj_lab', 'cre_time'], $temp)->execute();
            return true;
        }
        return false;
    }

    /**
     * 获取楼盘信息
     */
    public function getBuild()
    {
        return $this->hasOne(Build::className(), ['id' => 'build_id']);
    }

}
