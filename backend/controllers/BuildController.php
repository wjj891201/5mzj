<?php

namespace backend\controllers;

use Yii;

class BuildController extends CommonController
{

    /**
     * 楼盘列表
     */
    public function actionList()
    {

        return $this->render("list");
    }

    /**
     * 添加楼盘
     */
    public function actionAdd()
    {

        return $this->render("add");
    }

}
