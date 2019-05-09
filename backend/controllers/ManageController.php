<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use backend\models\SignupForm;

class ManageController extends CommonController
{

    /**
     * 修改密码
     * @return type
     */
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
//                echo exit("<script>top.location.href='" . Url::to(['login/login']) . "'></script>");
                return $this->redirect(['login/login']);
            }
        }
        return $this->render("psw", ['model' => $model]);
    }

    /**
     * 管理员列表
     */
    public function actionList()
    {


        return $this->render("list");
    }

}
