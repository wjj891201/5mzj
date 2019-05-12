<?php

namespace backend\controllers;

use Yii;

class SecHandController extends CommonController
{

    /**
     * 二手房管理
     */
    public function actionList()
    {
        return $this->render("list");
    }

}
