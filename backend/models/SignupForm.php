<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\BackendUser;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $id;
    public $username;
    public $real_name;
    public $sex;
    public $id_card;
    public $telphone;
    public $email;
    public $oldpass;
    public $password;
    public $re_password;
    public $created_at;
    public $updated_at;

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'real_name' => '姓名',
            'sex' => '性别',
            'id_card' => '身份证号码',
            'telphone' => '手机号码',
            'email' => '邮箱',
            'oldpass' => '原始密码',
            'password' => '密码',
            're_password' => '确认密码',
        ];
    }

    /**
     * @inheritdoc
     * 对数据的校验规则
     */
    public function rules()
    {
        return [
                [['username', 'email'], 'filter', 'filter' => 'trim', 'on' => ['signup', 'edit']],
                ['username', 'unique', 'targetClass' => '\backend\models\BackendUser', 'message' => '{attribute}已存在', 'on' => 'signup'],
                ['username', 'string', 'min' => 2, 'max' => 255, 'on' => ['signup', 'edit']],
                [['username', 'real_name', 'id_card', 'email', 'telphone'], 'required', 'message' => '{attribute}不可以为空', 'on' => ['signup', 'edit']],
                ['email', 'email', 'message' => '{attribute}格式不正确', 'on' => ['signup', 'edit']],
                ['email', 'unique', 'targetClass' => '\backend\models\BackendUser', 'message' => '{attribute}已经被设置了', 'on' => 'signup'],
                ['telphone', 'match', 'pattern' => '/^[1][358][0-9]{9}$/', 'message' => '{attribute}号码格式错误', 'on' => ['signup', 'edit']],
                ['oldpass', 'required', 'message' => '{attribute}不可以为空', 'on' => 'psw'],
                ['oldpass', 'validateOldpass', 'on' => 'psw'],
                [['password', 're_password'], 'required', 'message' => '{attribute}不可以为空', 'on' => ['signup', 'psw']],
                [['password', 're_password'], 'string', 'min' => 6, 'tooShort' => '{attribute}至少填写6位', 'on' => ['signup', 'psw']],
                ['re_password', 'compare', 'compareAttribute' => 'password', 'message' => '两次密码输入不一致', 'on' => ['signup', 'psw']],
                [['created_at', 'updated_at'], 'default', 'value' => time(), 'on' => 'signup'],
                ['sex', 'safe', 'on' => ['signup', 'edit']]
        ];
    }

    /**
     * 自定义的（原始密码）认证方法
     */
    public function validateOldpass($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = BackendUser::findOne(['id' => Yii::$app->backend_user->id]);
            if (!$user || !$user->validatePassword($this->oldpass))
            {
                $this->addError($attribute, '原始密码错误');
            }
        }
    }

    public static function getLists()
    {
        $list = BackendUser::find()->orderBy(['id' => SORT_DESC])->asArray()->all();
        return $list;
    }

    /**
     * Signs user up.
     * @return true|false 添加成功或者添加失败
     */
    public function signup($data)
    {
        $this->scenario = 'signup';
        if ($this->load($data) && $this->validate())
        {
            $user = new BackendUser();
            $user->username = $this->username;
            $user->real_name = $this->real_name;
            $user->sex = $this->sex;
            $user->id_card = $this->id_card;
            $user->telphone = $this->telphone;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->created_at = $this->created_at;
            $user->updated_at = $this->updated_at;
            return $user->save(false);
        }
    }

    /**
     * 编辑审批员
     */
    public function edit($data, $id)
    {
        $this->scenario = 'edit';
        if ($this->load($data) && $this->validate())
        {
            $user = BackendUser::findOne(['id' => $id]);
            $user->username = $this->username;
            $user->real_name = $this->real_name;
            $user->sex = $this->sex;
            $user->id_card = $this->id_card;
            $user->telphone = $this->telphone;
            $user->email = $this->email;
            return $user->save(false);
        }
    }

    /**
     * 修改密码
     */
    public function psw($data)
    {
        $this->scenario = 'psw';
        if ($this->load($data) && $this->validate())
        {
            $user = BackendUser::findOne(['id' => Yii::$app->backend_user->id]);
            $user->setPassword($this->password);
            $user->generateAuthKey();
            return $user->save(false);
        }
    }

}
