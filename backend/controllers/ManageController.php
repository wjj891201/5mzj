<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\data\Pagination;
use backend\models\SignupForm;
use backend\models\BackendUser;

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
        $model = BackendUser::find()->orderBy(['id' => SORT_DESC]);
        $count = $model->count();
        $pageSize = 10;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('list', ['data' => $data, 'pages' => $pages]);
    }

    /**
     * 添加管理员
     */
    public function actionAdd()
    {
        $model = new SignupForm();
        $model->sex = 1;
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->signup($post))
            {
                Yii::$app->session->setFlash("success", "添加成功");
                return $this->redirect(['manage/list']);
            }
        }
        return $this->render('add', ['model' => $model]);
    }

    /**
     * 添加管理员
     */
    public function actionEdit()
    {
        $id = Yii::$app->request->get('id');
        $info = BackendUser::find()->where(['id' => $id])->one();
        $model = new SignupForm();
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->edit($post, $id))
            {
                Yii::$app->session->setFlash("success", "编辑成功");
                return $this->redirect(['manage/list']);
            }
        }
        $model->username = $info->username;
        $model->real_name = $info->real_name;
        $model->sex = $info->sex;
        $model->id_card = $info->id_card;
        $model->telphone = $info->telphone;
        $model->email = $info->email;
        return $this->render('edit', ['model' => $model]);
    }

    /**
     * 删除管理员
     * @return type
     */
    public function actionDel()
    {
        $id = Yii::$app->request->get('id');
        BackendUser::deleteAll('id=:id', [':id' => $id]);
        Yii::$app->session->setFlash("success", "删除成功");
        return $this->redirect(['manage/list']);
    }

}
