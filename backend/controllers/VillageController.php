<?php

namespace backend\controllers;

use Yii;
use common\models\Village;
use common\models\Area;
use common\models\Street;
use common\models\Plate;

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
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post))
            {
                Yii::$app->session->setFlash("success", "添加成功");
                return $this->redirect(['village/list']);
            }
        }
        return $this->render("add", ['model' => $model, 'area' => $area, 'street' => $street, 'plate' => $plate]);
    }

    /**
     * AJAX获取街道、板块
     */
    public function actionAjaxGetStreetPlate()
    {
        $area_id = Yii::$app->request->post('area_id');
        $street = Street::find()->select(['streetID', 'street'])->where(['father' => $area_id])->asArray()->all();
        $plate = Plate::find()->select(['id', 'plate_name'])->where(['father' => $area_id])->asArray()->all();
        return json_encode(['street' => $street, 'plate' => $plate]);
    }

}
