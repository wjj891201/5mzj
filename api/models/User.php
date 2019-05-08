<?php

namespace api\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\filters\RateLimitInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $api_token 访问token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $allowance 剩余的允许的请求数量
 * @property int $allowance_updated_at 相应的UNIX时间戳数
 */
class User extends ActiveRecord implements IdentityInterface, RateLimitInterface
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'allowance', 'allowance_updated_at'], 'required'],
                [['status', 'created_at', 'updated_at', 'allowance', 'allowance_updated_at'], 'integer'],
                [['username', 'password_hash', 'password_reset_token', 'api_token', 'email'], 'string', 'max' => 255],
                [['auth_key'], 'string', 'max' => 32],
                [['username'], 'unique'],
                [['email'], 'unique'],
                [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'api_token' => 'Access Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'allowance' => 'Allowance',
            'allowance_updated_at' => 'Allowance Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['created_by' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if ($insert)
            {
                $this->created_at = time();
                $this->updated_at = time();
            }
            else
            {
                $this->updated_at = time();
            }

            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * 以下从user模型中拷贝过来修改
     */

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // 如果token无效的话，
        if (!static::apiTokenIsValid($token))
        {
            throw new \yii\web\UnauthorizedHttpException("token is invalid.");
        }
        return static::findOne(['api_token' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token))
        {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token))
        {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function generateAccessToken()
    {
        $this->api_token = Yii::$app->security->generateRandomString();
        return $this->api_token;
    }

    public function getRateLimit($request, $action)
    {
        return [3, 1];  //每秒只能请求3次
    }

    public function loadAllowance($request, $action)
    {
        return [$this->allowance, $this->allowance_updated_at];
    }

    public function saveAllowance($request, $action, $allowance, $timestamp)
    {
        $this->allowance = $allowance;
        $this->allowance_updated_at = $timestamp;
        $this->save();
    }

    /**
     * 生成 api_token
     */
    public function generateApiToken()
    {
        $this->api_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * 校验api_token是否有效
     */
    public static function apiTokenIsValid($token)
    {
        if (empty($token))
        {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.apiTokenExpire'];
        return $timestamp + $expire >= time();
    }

}
