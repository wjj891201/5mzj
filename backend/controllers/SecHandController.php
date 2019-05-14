<?php

namespace backend\controllers;

use Yii;
use common\models\House;
use common\models\DicItem;

class SecHandController extends CommonController
{

    /**
     * 二手房管理
     */
    public function actionList()
    {
        return $this->render("list");
    }

    /**
     * 二手房管理
     */
    public function actionAdd()
    {
        $model = new House;
        $model->is_mortgage = 0;
        $model->recommend = 0;
        $model->high_quality = 0;
        # 朝向
        $direction = DicItem::getDicItem(['p_id' => 1008000]);
        # 装修类型
        $decoration = DicItem::getDicItem(['p_id' => 1006000]);
        # 房屋类别
        $house_type = DicItem::getDicItem(['p_id' => 1040000]);
        # 房源标签
        $build_lab = DicItem::getDicItem(['p_id' => 1004011], false);
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post))
            {
                Yii::$app->session->setFlash("success", "添加成功");
                return $this->redirect(['sec-hand/list']);
            }
        }
        return $this->render("add", ['model' => $model, 'direction' => $direction, 'decoration' => $decoration, 'house_type' => $house_type, 'build_lab' => $build_lab]);
    }

}
