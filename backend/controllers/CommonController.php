<?php

namespace backend\controllers;

use yii\web\Controller;
use backend\models\BackendUser;
use backend\models\BackendUserRoleRelation;
use backend\models\RoleAccessRelation;
use backend\models\Access;
use Yii;

class CommonController extends Controller
{

    public $privilege_urls = [];

    public function beforeAction($action)
    {
        //1.0 先验证是否已经登录
        if (Yii::$app->backend_user->isGuest)
        {
            $this->redirect(['login/login']);
            Yii::$app->end();
        }
        //2.0 再验证权限
        if (!$this->checkPrivilege($action->getUniqueId()))
        {
            if (Yii::$app->request->isAjax)
            {
                exit('404');
            }
            else
            {
                $this->redirect(['error/forbidden']);
            }
            return false;
        }
        return true;
    }

    //检查是否有访问指定链接的权限
    public function checkPrivilege($url)
    {
        $userName = Yii::$app->backend_user->identity->username;
        //如果是超级管理员 也不需要权限判断
        $uDetail = BackendUser::find()->where(['username' => $userName])->one();
        if ($uDetail && $uDetail['is_admin'])
        {
            return true;
        }
        return in_array($url, $this->getRolePrivilege($uDetail['id']));
    }

    /*
     * 获取某用户的所有权限
     * 取出指定用户的所属角色，
     * 在通过角色 取出 所属 权限关系
     * 在权限表中取出所有的权限链接
     */

    public function getRolePrivilege($uid = 0)
    {
        if (!$this->privilege_urls)
        {
            $role_ids = BackendUserRoleRelation::find()->select('role_id')->where(['uid' => $uid])->asArray()->column();
            if ($role_ids)
            {
                //在通过角色 取出 所属 权限关系
                $access_ids = RoleAccessRelation::find()->where(['role_id' => $role_ids])->select('access_id')->asArray()->column();
                //在权限表中取出所有的权限链接
                $list = Access::find()->where(['id' => $access_ids])->asArray()->all();
                if ($list)
                {
                    foreach ($list as $_item)
                    {
                        $tmp_urls = @json_decode($_item['urls'], true);
                        //解决多个数据换行带来的问题
                        foreach ($tmp_urls as $k => $vo)
                        {
                            $tmp_urls[$k] = str_replace(["\r\n", "\r", "\n"], '', $vo);
                        }
                        $this->privilege_urls = array_merge($this->privilege_urls, $tmp_urls);
                    }
                }
            }
        }
        return $this->privilege_urls;
    }

}
