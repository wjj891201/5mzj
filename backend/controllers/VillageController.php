<?php

namespace backend\controllers;

use Yii;
use common\models\Village;
use common\models\Area;
use common\models\Street;

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
        $choice = ['' => '请选择'];
        $model = new Village();
        // 所属区域
        $area = Area::getOption(['father' => 320100]);
        // 所在街道
        $street = $choice;
        // 所在板块
        $plate = $choice;
        return $this->render("add", ['model' => $model, 'area' => $area, 'street' => $street, 'plate' => $plate]);
    }

}
