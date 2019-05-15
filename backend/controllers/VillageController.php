<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\libs\Tool;
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
        $vill_name = Yii::$app->request->post('vill_name', '');
        $model = Village::find()->alias('v')
                ->select(['v.id', 'v.vill_name', 'a.area', 'p.plate_name', 'v.vill_add', 'v.prop_comp', 'v.cre_time', 'v.mod_time'])
                ->leftJoin('{{%area}} a', 'a.areaID=v.vill_region')
                ->leftJoin('{{%plate}} p', 'p.id=v.plate_id')
                ->where(['v.is_del' => 0])
                ->filterWhere(['LIKE', 'v.vill_name', $vill_name])
                ->orderBy(['cre_time' => SORT_DESC]);
        $count = $model->count();
        $pageSize = 20;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render("list", ['data' => $data, 'pages' => $pages, 'vill_name' => $vill_name]);
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
     * 编辑小区
     */
    public function actionEdit()
    {
        $id = Yii::$app->request->get("id");
        $model = Village::find()->where(['id' => $id])->one();
        // 所属区域
        $area = Area::getOption(['father' => 320100]);
        // 所在街道
        $street = Street::getOption(['father' => $model->vill_region]);
        // 所在板块
        $plate = Plate::getOption(['father' => $model->vill_region]);
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post))
            {
                Yii::$app->session->setFlash("success", "编辑成功");
                return $this->redirect(['village/list']);
            }
        }
        return $this->render("add", ['model' => $model, 'area' => $area, 'street' => $street, 'plate' => $plate]);
    }

    /**
     * 删除删除
     */
    public function actionDel()
    {
        $id = Yii::$app->request->get('id');
        Village::updateAll(['is_del' => 1], ['id' => $id]);
        Yii::$app->session->setFlash("success", "删除成功");
        return $this->redirect(['village/list']);
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

    /**
     * 通过api获取小区
     */
    public function actionApi()
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
        else
        {
            $url = "https://restapi.amap.com/v3/place/text?key=e604d80b8882ccd02ba97be3c64dc08f&keywords=" . $params . "&types=120000&offset=10&page=" . $page . "&extensions=all&city=320100";
            $api_result = Tool::curl_request($url);
            $api_result = json_decode($api_result, true);
            $count = $api_result['count'];
            $village = $api_result['pois'];
            if (!empty($village))
            {
                foreach ($village as $key => $vo)
                {
                    $data[] = [
                        'vill_name' => $vo['name'],
                        'vill_add' => $vo['address'],
                        'vill_region' => $vo['adname'],
                        'location' => $vo['entr_location']
                    ];
                }
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
