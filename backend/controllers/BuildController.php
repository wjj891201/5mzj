<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use common\models\Build;
use common\models\DicItem;
use common\models\ObjLab;

class BuildController extends CommonController
{

    /**
     * 楼盘列表
     */
    public function actionList()
    {
        $model = Build::find()
                ->select(['id', 'build_name', 'build_add', 'comp_name', 'build_area', 'build_years', 'build_usetype', 'cre_time'])
                ->where(['is_del' => 0])
                ->orderBy(['cre_time' => SORT_DESC]);
        $count = $model->count();
        $pageSize = 20;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        # 建筑类别
        $houUsetype = DicItem::getDicItem('houUsetype');
        return $this->render("list", ['data' => $data, 'pages' => $pages, 'houUsetype' => $houUsetype]);
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
                return $this->redirect(['build/list']);
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

    /**
     * 编辑楼盘
     */
    public function actionEdit()
    {
        $id = Yii::$app->request->get("id");
        $model = Build::find()->where(['id' => $id])->one();
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->edit($post))
            {
                Yii::$app->session->setFlash("success", "编辑成功");
                return $this->redirect(['build/list']);
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
        // 1.0 楼盘标签
        $model->lab = ObjLab::find()->select('obj_lab')->where(['obj_type' => 100, 'tab_id' => $model['id']])->asArray()->column();
        return $this->render("add", [
                    'model' => $model,
                    'houUsetype' => $houUsetype, 'houBuildstr' => $houBuildstr, 'buildType' => $buildType, 'houFixState' => $houFixState,
                    'buildLab' => $buildLab
        ]);
    }

    /**
     * 删除楼盘
     */
    public function actionDel()
    {
        $id = Yii::$app->request->get('id');
        Build::updateAll(['is_del' => 1], ['id' => $id]);
        Yii::$app->session->setFlash("success", "删除成功");
        return $this->redirect(['build/list']);
    }

}
