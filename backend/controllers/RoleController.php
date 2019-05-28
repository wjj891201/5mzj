<?php

namespace backend\controllers;

use Yii;
use backend\models\Role;
use backend\models\RoleAccessRelation;
use backend\models\Access;

class RoleController extends CommonController
{

    /**
     * 角色列表
     */
    public function actionList()
    {
        $all_role = Role::getData();
        return $this->render('list', ['all_role' => $all_role]);
    }

    /**
     * 添加角色
     */
    public function actionAdd()
    {
        $model = new Role;
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post))
            {
                Yii::$app->session->setFlash("success", "添加成功");
                return $this->redirect(['role/list']);
            }
        }
        $access_list = Access::getAccess();
        $have_access = [];
        return $this->render('add', ['model' => $model, 'access_list' => $access_list, 'have_access' => $have_access]);
    }

    /**
     * 编辑角色
     */
    public function actionEdit()
    {
        $id = Yii::$app->request->get('id');
        $model = Role::findOne($id);
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->modify($post))
            {
                Yii::$app->session->setFlash("success", "编辑成功");
                return $this->redirect(['role/list']);
            }
        }
        //查出所有的权限
        $access_list = Access::getAccess();
        //查找该角色的权限
        $have_access = RoleAccessRelation::find()->select('access_id')->where(['role_id' => $id])->asArray()->column();
        return $this->render('add', ['model' => $model, 'access_list' => $access_list, 'have_access' => $have_access]);
    }

}
