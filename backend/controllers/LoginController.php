<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\LoginForm;

class LoginController extends Controller
{

    public function actionLogin()
    {
        // 判断用户是访客还是认证用户 
//        if (!Yii::$app->approvr_user->isGuest)
//        {
//            $this->redirect(['public/index']);
//            Yii::$app->end();
//        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            echo 123;
            exit;
//            $this->redirect(['handle/wait-for']);
//            Yii::$app->end();
        }
        else
        {
            return $this->renderPartial('login', ['model' => $model]);
        }
    }

}
