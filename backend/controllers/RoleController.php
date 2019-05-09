<?php

namespace backend\controllers;

use Yii;

class RoleController extends CommonController
{

    /**
     * 角色列表
     */
    public function actionList()
    {


        return $this->render("list");
    }

    /**
     * 添加角色
     */
    public function actionAdd()
    {

        return $this->render("add");
    }

}
