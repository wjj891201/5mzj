<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\LoginForm;

class LoginController extends Controller
{

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'backColor' => 0x51ACFF,
                'foreColor' => 0xffffff,
                'height' => 42,
                'width' => 76,
                'minLength' => 4,
                'maxLength' => 4
            ],
        ];
    }

    public function actionLogin()
    {
        // 判断用户是访客还是认证用户 
        if (!Yii::$app->backend_user->isGuest)
        {
            $this->redirect(['home/index']);
            Yii::$app->end();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            $this->redirect(['home/index']);
            Yii::$app->end();
        }
        else
        {
            return $this->renderPartial('login', ['model' => $model]);
        }
    }

}
