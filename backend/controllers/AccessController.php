<?php

namespace backend\controllers;

use Yii;
use backend\models\Access;
use backend\models\RoleAccessRelation;

class AccessController extends CommonController
{

    /**
     * 权限列表
     */
    public function actionList()
    {
        $model = new Access();
        $access = $model->getTreeList();
        return $this->render("list", ['access' => $access]);
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

    public function actionMod()
    {
        $id = Yii::$app->request->get("id");
        $model = Access::find()->where('id = :id', [':id' => $id])->one();
        $list = $model->getOptions();
        $model->urls = implode("\n", json_decode($model->urls, 1));
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->modify($post))
            {
                Yii::$app->session->setFlash("success", "编辑成功");
                return $this->redirect(['access/mod', 'id' => $id]);
            }
        }
        return $this->render('add', ['model' => $model, 'list' => $list]);
    }

    public function actionDel()
    {
        $id = Yii::$app->request->get('id');
        if (Access::deleteAll('id = :id', [":id" => $id]))
        {
            RoleAccessRelation::deleteAll(['access_id' => $id]);
            echo '1';
            exit;
        }
    }

}
