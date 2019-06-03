<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use common\models\Build;
use common\models\DicItem;
use common\models\ObjLab;
use common\models\BuildHoutype;
use common\models\BuildOpen;

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
        $type_name = Yii::$app->request->get('type_name', '');
        $cover_area = Yii::$app->request->get('cover_area', '');
        $model = BuildHoutype::find()->alias('t')
                ->select(['t.*', 'b.build_name'])
                ->leftJoin('{{%build}} b', 'b.id=t.build_id')
                ->where(['t.is_del' => 0])
                ->filterWhere(['LIKE', 't.type_name', $type_name])
                ->filterWhere(['<=', 't.cover_area', $cover_area])
                ->orderBy(['t.cre_time' => SORT_DESC]);
        $count = $model->count();
        $pageSize = 20;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        # 户型类别
        $houRoomType = DicItem::getDicItem('houRoomType');
        return $this->render("house-type-list", [
                    'type_name' => $type_name, 'cover_area' => $cover_area,
                    'data' => $data, 'pages' => $pages, 'houRoomType' => $houRoomType
        ]);
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
     * 楼盘户型编辑
     */
    public function actionHouseTypeEdit()
    {
        $id = Yii::$app->request->get('id');
        $model = BuildHoutype::find()->where(['id' => $id])->one();
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->edit($post))
            {
                Yii::$app->session->setFlash("success", "编辑成功");
                return $this->redirect(['build/house-type-list']);
            }
        }
        # 户型类别
        $houRoomType = DicItem::getDicItem('houRoomType');
        # 楼盘标签
        $houseTypeLab = DicItem::getDicItem('houseTypeLab', false);
        // 1.0 楼盘标签
        $model->build_name = $model['build']['build_name'];
        // 2.0 户型标签
        $model->lab = ObjLab::find()->select('obj_lab')->where(['obj_type' => 103, 'tab_id' => $model->id])->asArray()->column();
        return $this->render("house-type-add", ['model' => $model, 'houRoomType' => $houRoomType, 'houseTypeLab' => $houseTypeLab]);
    }

    /**
     * 删除楼盘户型
     */
    public function actionHouseTypeDel()
    {
        $id = Yii::$app->request->get('id');
        BuildHoutype::updateAll(['is_del' => 1], ['id' => $id]);
        Yii::$app->session->setFlash("success", "删除成功");
        return $this->redirect(['build/house-type-list']);
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

    /**
     * 楼盘开盘列表
     */
    public function actionOpenList()
    {
        $build_name = Yii::$app->request->get('build_name', '');
        $model = BuildOpen::find()->alias('o')
                ->select(['o.*', 'b.build_name'])
                ->innerJoin('{{%build}} b', 'b.id=o.build_id')
                ->where(['o.is_del' => 0])
                ->filterWhere(['LIKE', 'b.build_name', $build_name])
                ->orderBy(['o.cre_time' => SORT_DESC]);
        $count = $model->count();
        $pageSize = 20;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render("open-list", ['build_name' => $build_name, 'data' => $data, 'pages' => $pages]);
    }

    /**
     * 新增开盘
     */
    public function actionOpenAdd()
    {
        $model = new BuildOpen;
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post))
            {
                Yii::$app->session->setFlash("success", "添加成功");
                return $this->redirect(['build/open-list']);
            }
        }
        $model->high_quality = 0;
        $model->recommend = 0;
        return $this->render("open-add", ['model' => $model]);
    }

    /**
     * 编辑开盘
     */
    public function actionOpenEdit()
    {
        $id = Yii::$app->request->get('id');
        $model = BuildOpen::find()->where(['id' => $id])->one();
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->edit($post))
            {
                Yii::$app->session->setFlash("success", "编辑成功");
                return $this->redirect(['build/open-list']);
            }
        }
        // 1.0 楼盘名称
        $model->build_name = $model['build']['build_name'];
        // 2.0 单选控制
        switch ($model->is_recomm)
        {
            case 0:
                $model->recommend = 0;
                $model->high_quality = 0;
                break;
            case 1:
                $model->recommend = 1;
                $model->high_quality = 0;
                break;
            case 2:
                $model->recommend = 0;
                $model->high_quality = 1;
                break;
            case 3:
                $model->recommend = 1;
                $model->high_quality = 1;
                break;
        }
        return $this->render("open-add", ['model' => $model]);
    }

    /**
     * 删除开盘
     */
    public function actionOpenDel()
    {
        $id = Yii::$app->request->get('id');
        BuildOpen::updateAll(['is_del' => 1], ['id' => $id]);
        Yii::$app->session->setFlash("success", "删除成功");
        return $this->redirect(['build/open-list']);
    }

}
