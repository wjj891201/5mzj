<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use common\models\House;
use common\models\DicItem;
use common\models\ObjLab;
use common\models\Village;

class LeaseController extends CommonController
{

    /**
     * 出租房管理
     */
    public function actionList()
    {
        $mob_phone = Yii::$app->request->post('mob_phone', '');
        $hou_name = Yii::$app->request->post('hou_name', '');
        $vill_name = Yii::$app->request->post('vill_name', '');
        $price1_s = Yii::$app->request->post('price1_s', '');
        $price1_e = Yii::$app->request->post('price1_e', '');
        $to_price1_s = Yii::$app->request->post('to_price1_s', '');
        $to_price1_e = Yii::$app->request->post('to_price1_e', '');

        $model = House::find()->alias('h')
                ->select(['h.id', 'h.hou_account', 'h.hou_name', 'v.vill_name', 's.price1', 's.to_price1', 'h.hou_area', 's.hou_pub_state', 'h.cre_time', 'h.mod_time'])
                ->innerJoin('{{%village}} v', 'v.id=h.vill_id')
                ->innerJoin('{{%house_sales}} s', 's.house_id=h.id')
                ->innerJoin('{{%house_sal_owner}} o', 'o.house_id=h.id')
                ->where(['AND', ['h.is_del' => 0], ['IN', 's.sales_type', [101, 102]]])
                ->andFilterWhere(['LIKE', 'o.mob_phone', $mob_phone])
                ->andFilterWhere(['LIKE', 'h.hou_name', $hou_name])
                ->andFilterWhere(['LIKE', 'v.vill_name', $vill_name])
                ->andFilterWhere(['>=', 's.price1', $price1_s])
                ->andFilterWhere(['<=', 's.price1', $price1_e])
                ->andFilterWhere(['>=', 's.to_price1', $to_price1_s])
                ->andFilterWhere(['<=', 's.to_price1', $to_price1_e])
                ->orderBy(['h.cre_time' => SORT_DESC]);
        $count = $model->count();
        $pageSize = 20;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render("list", [
                    'data' => $data, 'pages' => $pages,
                    'mob_phone' => $mob_phone, 'hou_name' => $hou_name, 'vill_name' => $vill_name,
                    'price1_s' => $price1_s, 'price1_e' => $price1_e, 'to_price1_s' => $to_price1_s, 'to_price1_e' => $to_price1_e
        ]);
    }

    /**
     * 出租房添加
     */
    public function actionAdd()
    {
        $model = new House;
        $model->is_mortgage = 0;
        $model->recommend = 0;
        $model->high_quality = 0;
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->lease_add($post))
            {
                Yii::$app->session->setFlash("success", "添加成功");
                return $this->redirect(['lease/list']);
            }
        }
        # 朝向
        $direction = DicItem::getDicItem(['p_id' => 1008000]);
        # 装修类型
        $decoration = DicItem::getDicItem(['p_id' => 1006000]);
        # 房屋类别
        $house_type = DicItem::getDicItem(['p_id' => 1040000]);
        # 租赁方式
        $lease_type = DicItem::getDicItem(['p_id' => 1001010107]);
        # 付款方式
        $pay_type = DicItem::getDicItem(['p_id' => 1002000000]);
        # 房源标签
        $build_lab = DicItem::getDicItem(['p_id' => 1001010110], false);
        return $this->render("add", [
                    'model' => $model, 'direction' => $direction, 'decoration' => $decoration, 'house_type' => $house_type,
                    'lease_type' => $lease_type, 'pay_type' => $pay_type, 'build_lab' => $build_lab
        ]);
    }

    /**
     * 出租房编辑
     */
    public function actionEdit()
    {
        $id = Yii::$app->request->get("id");
        $model = House::find()->where(['id' => $id])->one();
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->lease_edit($post))
            {
                Yii::$app->session->setFlash("success", "编辑成功");
                return $this->redirect(['lease/list']);
            }
        }
        # 朝向
        $direction = DicItem::getDicItem(['p_id' => 1008000]);
        # 装修类型
        $decoration = DicItem::getDicItem(['p_id' => 1006000]);
        # 房屋类别
        $house_type = DicItem::getDicItem(['p_id' => 1040000]);
        # 租赁方式
        $lease_type = DicItem::getDicItem(['p_id' => 1001010107]);
        # 付款方式
        $pay_type = DicItem::getDicItem(['p_id' => 1002000000]);
        # 房源标签
        $build_lab = DicItem::getDicItem(['p_id' => 1004011], false);
        # 初始数据
        // 1.0 小区信息
        $model->vill_name = $model['village']['vill_name'];
        // 2.0 房源出售信息
        $model->price1 = $model['houseSales']['price1'];
        $model->to_price1 = $model['houseSales']['to_price1'];
        $model->is_mortgage = $model['houseSales']['is_mortgage'];
        $model->user_grade = $model['houseSales']['user_grade'];
        $is_recomm = $model['houseSales']['is_recomm'];
        switch ($is_recomm)
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
        // 3.0 户型信息
        $model->type_hab = $model['houseType']['type_hab'];
        $model->type_hall = $model['houseType']['type_hall'];
        $model->type_toilet = $model['houseType']['type_toilet'];
        // 4.0 房源出售人信息
        $model->house_owner = $model['houseSalOwner']['house_owner'];
        $model->mob_phone = $model['houseSalOwner']['mob_phone'];
        // 5.0 房源标签
        $model->lab = ObjLab::find()->select('obj_lab')->where(['tab_id' => $model['houseSales']['id']])->asArray()->column();
        return $this->render("add", [
                    'model' => $model, 'direction' => $direction, 'decoration' => $decoration, 'house_type' => $house_type,
                    'lease_type' => $lease_type, 'pay_type' => $pay_type, 'build_lab' => $build_lab
        ]);
    }

    /**
     * 删除出租房
     */
    public function actionDel()
    {
        $id = Yii::$app->request->get('id');
        House::updateAll(['is_del' => 1], ['id' => $id]);
        Yii::$app->session->setFlash("success", "删除成功");
        return $this->redirect(['lease/list']);
    }

    /**
     * 通过数据库获取小区
     */
    public function actionGetVillage()
    {
        $params = Yii::$app->request->get('params');
        $page = Yii::$app->request->get('page');
        $limit = Yii::$app->request->get('limit');
        $village = Village::find()->alias('v')
                        ->select(['v.id', 'v.vill_name', 'v.vill_add', 'v.vill_region', 'a.area', 'v.vill_long', 'v.vill_lat'])
                        ->leftJoin("{{%area}} a", 'a.areaID=v.vill_region')
                        ->where(['AND', ['LIKE', 'v.vill_name', $params], ['v.is_del' => 0]])
                        ->offset(($page - 1) * $limit)->limit($limit)->asArray()->all();
        $count = Village::find()->where(['LIKE', 'vill_name', $params])->count();
        $data = [];
        if ($count > 0)
        {
            foreach ($village as $key => $vo)
            {
                $data[] = [
                    'vill_name' => $vo['vill_name'],
                    'vill_add' => $vo['vill_add'],
                    'vill_region' => $vo['area'],
                    'location' => $vo['vill_long'] . ',' . $vo['vill_lat']
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