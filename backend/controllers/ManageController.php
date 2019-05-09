<?php

namespace backend\controllers;

use Yii;
use backend\models\SignupForm;

class ManageController extends CommonController
{

    public function actionPsw()
    {
        $model = new SignupForm;
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->psw($post))
            {
                //退出到登录界面
                Yii::$app->backend_user->logout();
                return $this->redirect(['login/login']);
            }
        }
        return $this->render("psw", ['model' => $model]);
    }

}
