<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;

class BuildOpen extends ActiveRecord
{

    public $build_name, $high_quality, $recommend;

    public static function tableName()
    {
        return "{{%build_open}}";
    }

    public function attributeLabels()
    {
        return [
            'build_name' => '楼盘名称',
            'open_time' => '开盘时间',
            'price' => '参考单价',
            'to_price' => '参考总价',
            'turn_time' => '交房时间',
            'checkin_time' => '入住时间',
            'hou_type' => '户型分布说明',
            'open_remark' => '开盘详情'
        ];
    }

    public function rules()
    {
        return [
                [['build_name', 'open_time', 'price', 'to_price', 'turn_time', 'checkin_time', 'hou_type', 'open_remark'], 'required', 'message' => '{attribute}为必填项'],
                ['build_name', 'filter', 'filter' => 'trim'],
                ['build_name', 'validateBuildName'],
                [['high_quality', 'recommend'], 'safe']
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
            $build_open_id = Yii::$app->db->getLastInsertID();
            $is_recomm = self::handRecomm($this->recommend, $this->high_quality);
            self::updateAll(['is_recomm' => $is_recomm], ['id' => $build_open_id]);
            return true;
        }
        return false;
    }

    public function edit($data)
    {
        $this->mod_time = date('Y-m-d H:i:s');
        if ($this->load($data) && $this->save())
        {
            $build_open_id = $this->id;
            $is_recomm = self::handRecomm($this->recommend, $this->high_quality);
            self::updateAll(['is_recomm' => $is_recomm], ['id' => $build_open_id]);
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
     * 获取楼盘信息
     */
    public function getBuild()
    {
        return $this->hasOne(Build::className(), ['id' => 'build_id']);
    }

}
