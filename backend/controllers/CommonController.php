<?php

namespace backend\controllers;

use yii\web\Controller;
use Yii;

class CommonController extends Controller
{

    public function beforeAction($action)
    {
        //1.0 先验证是否已经登录
        if (Yii::$app->backend_user->isGuest)
        {
            $this->redirect(['/login/login']);
            Yii::$app->end();
        }
        return true;
    }

}
