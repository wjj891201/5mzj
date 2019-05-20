<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use common\models\Build;
use common\models\DicItem;
use common\models\ObjLab;
use common\models\BuildHoutype;

class BuildController extends CommonController
{

    /**
     * 楼盘列表
     */
    public function actionList()
    {
        $build_name = Yii::$app->request->post('build_name');
        $model = Build::find()
                ->select(['id', 'build_name', 'build_add', 'comp_name', 'build_area', 'build_years', 'build_usetype', 'cre_time'])
                ->where(['is_del' => 0])
                ->andFilterWhere(['LIKE', 'build_name', $build_name])
                ->orderBy(['cre_time' => SORT_DESC]);
        $count = $model->count();
        $pageSize = 20;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        # 建筑类别
        $houUsetype = DicItem::getDicItem('houUsetype');
        return $this->render("list", ['data' => $data, 'pages' => $pages, 'build_name' => $build_name, 'houUsetype' => $houUsetype]);
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

    /**
     * 楼盘户型列表
     */
    public function actionHouseTypeList()
    {

        return $this->render("house-type-list");
    }

    /**
     * 楼盘户型添加
     */
    public function actionHouseTypeAdd()
    {
        $model = new BuildHoutype;
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post))
            {
                Yii::$app->session->setFlash("success", "添加成功");
                return $this->redirect(['build/house-type-list']);
            }
        }
        # 户型类别
        $houRoomType = DicItem::getDicItem('houRoomType');
        # 楼盘标签
        $houseTypeLab = DicItem::getDicItem('houseTypeLab', false);
        return $this->render("house-type-add", ['model' => $model, 'houRoomType' => $houRoomType, 'houseTypeLab' => $houseTypeLab]);
    }

    /**
     * ajax获取楼盘
     */
    public function actionGetBuilds()
    {
        $params = Yii::$app->request->get('params');
        $page = Yii::$app->request->get('page');
        $limit = Yii::$app->request->get('limit');
        $build = Build::find()->select(['id', 'build_name', 'build_add', 'comp_name'])
                        ->where(['AND', ['LIKE', 'build_name', $params], ['is_del' => 0]])
                        ->offset(($page - 1) * $limit)->limit($limit)->asArray()->all();
        $count = Build::find()->where(['AND', ['LIKE', 'build_name', $params], ['is_del' => 0]])->count();
        $data = [];
        if ($count > 0)
        {
            foreach ($build as $key => $vo)
            {
                $data[] = [
                    'build_name' => $vo['build_name'],
                    'build_add' => $vo['build_add'],
                    'comp_name' => $vo['comp_name']
                ];
            }
        }
        $result = [
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data' => $data
        ];
        return json_encode($result);
    }

}
