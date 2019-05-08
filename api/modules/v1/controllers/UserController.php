<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
# use yii\filters\auth\QueryParamAuth; //通过get方式传递token
use yii\filters\auth\HttpBearerAuth; //通过header头传递
# use api\models\User;
use api\models\LoginForm;

class UserController extends ActiveController
{

    public $modelClass = 'api\models\User';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
                    'authenticator' => [
                        'class' => HttpBearerAuth::className(),
                        'optional' => [
                            'login',
                            'signup-test'
                        ]
                    ]
        ]);
    }

    /**
     * 添加测试用户
     */
//    public function actionSignupTest()
//    {
//        $user = new User();
//        $user->generateAuthKey();
//        $user->setPassword('222');
//        $user->username = '222';
//        $user->email = '222@222.com';
//
//        return $user->save(false);
//    }

    /**
     * 登录
     */
    public function actionLogin()
    {
        $model = new LoginForm;
        $model->setAttributes(Yii::$app->request->post());
        if (($user = $model->login()))
        {
            return ['token' => $user->api_token];
        }
        else
        {
            $errors = $model->errors;
            $firstError = current($errors);
            return ['msg' => $firstError[0]];
        }
    }

    /**
     * 获取用户信息
     */
    public function actionUserProfile()
    {
        // 到这一步，token都认为是有效的了
        // 下面只需要实现业务逻辑即可
        $user = $this->authenticate(Yii::$app->user, Yii::$app->request, Yii::$app->response);
        return [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
        ];
    }

}
