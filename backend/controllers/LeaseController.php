<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use common\models\House;
use common\models\DicItem;
use common\models\ObjLab;
use common\models\Village;
use common\models\HouseSales;

class LeaseController extends CommonController
{

    /**
     * 出租房管理
     */
    public function actionList()
    {
        $hou_name = Yii::$app->request->post('hou_name', '');
        $vill_name = Yii::$app->request->post('vill_name', '');
        $price1_s = Yii::$app->request->post('price1_s', '');
        $price1_e = Yii::$app->request->post('price1_e', '');
        $sales_type = Yii::$app->request->post('sales_type', '');
        $pub_state = Yii::$app->request->get('pub_state', '103');
        # 租赁方式
        $lease_type = DicItem::getDicItem('tenement');
        # 付款方式
        $pay_type = DicItem::getDicItem('rentPay');
        $model = House::find()->alias('h')
                ->select([
                    'h.id', 'h.hou_account', 'h.hou_name', 'h.hou_area', 'v.vill_name', 's.sales_type', 's.price1', 's.price2_remark',
                    's.hou_pub_state', 'h.cre_time', 'h.mod_time'
                ])
                ->innerJoin('{{%village}} v', 'v.id=h.vill_id')
                ->innerJoin('{{%house_sales}} s', 's.house_id=h.id')
                ->where(['AND', ['h.is_del' => 0], ['IN', 's.sales_type', [101, 102]]])
                ->andFilterWhere(['LIKE', 'h.hou_name', $hou_name])
                ->andFilterWhere(['LIKE', 'v.vill_name', $vill_name])
                ->andFilterWhere(['>=', 's.price1', $price1_s])
                ->andFilterWhere(['<=', 's.price1', $price1_e])
                ->andFilterWhere(['s.sales_type' => $sales_type])
                ->andFilterWhere(['s.hou_pub_state' => $pub_state])
                ->orderBy(['h.cre_time' => SORT_DESC]);
        $count = $model->count();
        $pageSize = 20;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render("list", [
                    'data' => $data, 'pages' => $pages, 'count' => $count,
                    'lease_type' => $lease_type, 'pay_type' => $pay_type,
                    'hou_name' => $hou_name, 'vill_name' => $vill_name, 'price1_s' => $price1_s, 'price1_e' => $price1_e, 'sales_type' => $sales_type,
                    'pub_state' => $pub_state
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
        $direction = DicItem::getDicItem('houTurn');
        # 装修类型
        $decoration = DicItem::getDicItem('houFixState');
        # 房屋类别
        $house_type = DicItem::getDicItem('houUsetype');
        # 租赁方式
        $lease_type = DicItem::getDicItem('tenement');
        # 付款方式
        $pay_type = DicItem::getDicItem('rentPay');
        # 房源标签
        $build_lab = DicItem::getDicItem('LabelByrent', false);
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
        $direction = DicItem::getDicItem('houTurn');
        # 装修类型
        $decoration = DicItem::getDicItem('houFixState');
        # 房屋类别
        $house_type = DicItem::getDicItem('houUsetype');
        # 租赁方式
        $lease_type = DicItem::getDicItem('tenement');
        # 付款方式
        $pay_type = DicItem::getDicItem('rentPay');
        # 房源标签
        $build_lab = DicItem::getDicItem('LabelByrent', false);
        # 初始数据
        // 1.0 小区信息
        $model->vill_name = $model['village']['vill_name'];
        // 2.0 房源出售信息
        $model->price1 = $model['houseSales']['price1'];
        // 3.0 户型信息
        $model->type_hab = $model['houseType']['type_hab'];
        $model->type_hall = $model['houseType']['type_hall'];
        $model->type_toilet = $model['houseType']['type_toilet'];
        // 4.0 租赁方式信息
        $model->sales_type = $model['houseSales']['sales_type'];
        // 5.0 付款方式信息
        $model->price2_remark = $model['houseSales']['price2_remark'];
        // 6.0 房源出售人信息
        $model->house_owner = $model['houseSalOwner']['house_owner'];
        $model->mob_phone = $model['houseSalOwner']['mob_phone'];
        // 7.0 房源标签
        $model->lab = ObjLab::find()->select('obj_lab')->where(['obj_type' => 102, 'tab_id' => $model['houseSales']['id']])->asArray()->column();
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
     * 改变状态
     */
    public function actionChangeState()
    {
        $house_id = Yii::$app->request->get('id');
        $next_state = Yii::$app->request->get('next_state');
        HouseSales::updateAll(['hou_pub_state' => $next_state], ['house_id' => $house_id]);
        Yii::$app->session->setFlash("success", "操作成功");
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
