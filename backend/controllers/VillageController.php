<?php

namespace backend\controllers;

use Yii;
use common\models\Village;

class VillageController extends CommonController
{

    /**
     * 小区列表
     */
    public function actionList()
    {

        return $this->render("list");
    }

    /**
     * 添加小区
     */
    public function actionAdd()
    {
        $model = new Village();

        return $this->render("add", ['model' => $model]);
    }

}
