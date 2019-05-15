<?php

namespace backend\controllers;

use Yii;
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
                        ->where(['LIKE', 'v.vill_name', $params])
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
