<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\data\Pagination;
use backend\models\SignupForm;
use backend\models\BackendUser;
use backend\models\BackendUserRoleRelation;
use backend\models\Role;

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

    /**
     * 管理员赋予角色
     * @return type
     */
    public function actionMake()
    {
        $id = Yii::$app->request->get("id");
        //查找该用户的角色
        $have_role = BackendUserRoleRelation::find()->select('role_id')->where(['uid' => $id])->asArray()->column();
        //用户信息
        $userDetail = BackendUser::find()->where('id = :id', [':id' => $id])->one();
        $role = Role::find()->all();
        if (Yii::$app->request->isPost)
        {
            $role_ids = Yii::$app->request->post("role_id");
            // 交集
            $collection = array_intersect($have_role, $role_ids);
            // 差集
            $diff_1 = array_diff($have_role, $collection);
            $diff_2 = array_diff($role_ids, $collection);
            // $diff_1删除 $diff_2添加
            if (!empty($diff_1))
            {
                BackendUserRoleRelation::deleteAll(['AND', ['uid' => $id], ['IN', 'role_id', $diff_1]]);
            }
            if (!empty($diff_2))
            {
                $temp = [];
                foreach ($diff_2 as $key => $vo)
                {
                    $temp[$key] = ['uid' => $id, 'role_id' => $vo, 'created_time' => date('Y-m-d H:i:s')];
                }
                Yii::$app->db->createCommand()->batchInsert("{{%backend_user_role}}", ['uid', 'role_id', 'created_time'], $temp)->execute();
            }
            Yii::$app->session->setFlash('success', '角色分配成功！');
            return $this->redirect(['manage/list']);
        }
        return $this->render('make', ['userDetail' => $userDetail, 'role' => $role, 'have_role' => $have_role]);
    }

}
