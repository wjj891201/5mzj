<?php

namespace backend\controllers;

use Yii;
use common\models\Build;
use common\models\DicItem;

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
        $model = new Build;
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post))
            {
                Yii::$app->session->setFlash("success", "添加成功");
                return $this->redirect(['lease/list']);
            }
        }
        # 用途类型
        $houUsetype = DicItem::getDicItem('houUsetype');
        # 房屋结构类型
        $houBuildstr = DicItem::getDicItem('houBuildstr');
        # 建筑类别
        $buildType = DicItem::getDicItem('buildType');
        # 交付标准
        $houFixState = DicItem::getDicItem('houFixState');
        # 楼盘标签
        $buildLab = DicItem::getDicItem('buildLab', false);

        return $this->render("add", [
                    'model' => $model,
                    'houUsetype' => $houUsetype, 'houBuildstr' => $houBuildstr, 'buildType' => $buildType, 'houFixState' => $houFixState,
                    'buildLab' => $buildLab
        ]);
    }

}
