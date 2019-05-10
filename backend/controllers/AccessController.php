<?php

namespace backend\controllers;

use Yii;
use backend\models\Access;

class AccessController extends CommonController
{

    /**
     * 权限列表
     */
    public function actionList()
    {


        return $this->render("list");
    }

    /**
     * 添加权限
     */
    public function actionAdd()
    {
        $model = new Access;
        $model->sort = 100;
        $list = $model->getOptions();
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post))
            {
                Yii::$app->session->setFlash("success", "添加成功");
                return $this->redirect(['access/add']);
            }
        }
        return $this->render('add', ['model' => $model, 'list' => $list]);
    }

}
