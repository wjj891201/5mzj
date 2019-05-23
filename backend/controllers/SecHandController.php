<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use common\models\House;
use common\models\DicItem;
use common\models\ObjLab;
use common\models\Village;
use common\models\HouseSales;
use backend\libs\Upload;
use backend\libs\Ftp;

class SecHandController extends CommonController
{

    /**
     * 二手房管理
     */
    public function actionList()
    {
        $mob_phone = Yii::$app->request->get('mob_phone', '');
        $hou_name = Yii::$app->request->get('hou_name', '');
        $vill_name = Yii::$app->request->get('vill_name', '');
        $price1_s = Yii::$app->request->get('price1_s', '');
        $price1_e = Yii::$app->request->get('price1_e', '');
        $to_price1_s = Yii::$app->request->get('to_price1_s', '');
        $to_price1_e = Yii::$app->request->get('to_price1_e', '');
        $pub_state = Yii::$app->request->get('pub_state', '103');

        $model = House::find()->alias('h')
                ->select(['h.id', 'h.hou_account', 'h.hou_name', 'v.vill_name', 's.price1', 's.to_price1', 'h.hou_area', 's.hou_pub_state', 'h.cre_time', 'h.mod_time'])
                ->innerJoin('{{%village}} v', 'v.id=h.vill_id')
                ->innerJoin('{{%house_sales}} s', 's.house_id=h.id')
                ->innerJoin('{{%house_sal_owner}} o', 'o.house_id=h.id')
                ->where(['AND', ['h.is_del' => 0], ['s.sales_type' => 100]])
                ->andFilterWhere(['LIKE', 'o.mob_phone', $mob_phone])
                ->andFilterWhere(['LIKE', 'h.hou_name', $hou_name])
                ->andFilterWhere(['LIKE', 'v.vill_name', $vill_name])
                ->andFilterWhere(['>=', 's.price1', $price1_s])
                ->andFilterWhere(['<=', 's.price1', $price1_e])
                ->andFilterWhere(['>=', 's.to_price1', $to_price1_s])
                ->andFilterWhere(['<=', 's.to_price1', $to_price1_e])
                ->andFilterWhere(['s.hou_pub_state' => $pub_state])
                ->orderBy(['h.cre_time' => SORT_DESC]);
        $count = $model->count();
        $pageSize = 20;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render("list", [
                    'data' => $data, 'pages' => $pages, 'count' => $count,
                    'mob_phone' => $mob_phone, 'hou_name' => $hou_name, 'vill_name' => $vill_name,
                    'price1_s' => $price1_s, 'price1_e' => $price1_e, 'to_price1_s' => $to_price1_s, 'to_price1_e' => $to_price1_e,
                    'pub_state' => $pub_state
        ]);
    }

    /**
     * 二手房添加
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
            if ($model->add($post))
            {
                Yii::$app->session->setFlash("success", "添加成功");
                return $this->redirect(['sec-hand/list']);
            }
        }
        # 朝向
        $direction = DicItem::getDicItem('houTurn');
        # 装修类型
        $decoration = DicItem::getDicItem('houFixState');
        # 房屋类别
        $house_type = DicItem::getDicItem('houUsetype');
        # 房源标签
        $build_lab = DicItem::getDicItem('houseLab', false);
        return $this->render("add", ['model' => $model, 'direction' => $direction, 'decoration' => $decoration, 'house_type' => $house_type, 'build_lab' => $build_lab]);
    }

    /**
     * 二手房编辑
     */
    public function actionEdit()
    {
        $id = Yii::$app->request->get("id");
        $model = House::find()->where(['id' => $id])->one();
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->edit($post))
            {
                Yii::$app->session->setFlash("success", "编辑成功");
                return $this->redirect(['sec-hand/list']);
            }
        }
        # 朝向
        $direction = DicItem::getDicItem('houTurn');
        # 装修类型
        $decoration = DicItem::getDicItem('houFixState');
        # 房屋类别
        $house_type = DicItem::getDicItem('houUsetype');
        # 房源标签
        $build_lab = DicItem::getDicItem('houseLab', false);
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
        $model->lab = ObjLab::find()->select('obj_lab')->where(['obj_type' => 102, 'tab_id' => $model['houseSales']['id']])->asArray()->column();
        return $this->render("add", ['model' => $model, 'direction' => $direction, 'decoration' => $decoration, 'house_type' => $house_type, 'build_lab' => $build_lab]);
    }

    /**
     * 删除二手房
     */
    public function actionDel()
    {
        $id = Yii::$app->request->get('id');
        House::updateAll(['is_del' => 1], ['id' => $id]);
        Yii::$app->session->setFlash("success", "删除成功");
        return $this->redirect(['sec-hand/list']);
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
        return $this->redirect(['sec-hand/list']);
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

    public function actionUpload()
    {

        $fileName = str_replace('\\', '/', __DIR__);
        $fileName = dirname($fileName);
//        $file = $_FILES['file'];
        $conn = ftp_connect('47.110.236.17') or exit("Could not connect ftp");
        ftp_login($conn, 'ftpuser', 'JUFangFtp123456');
        ftp_pasv($conn, true);

        $path = 'upload/uploadfiles/house_images/' . date('Y-m-d');


        $path_arr = explode('/', $path); // 取目录数组
//        $file_name = array_pop($path_arr); // 弹出文件名
        $path_div = count($path_arr); // 取层数
        foreach ($path_arr as $val) // 创建目录
        {
            if (ftp_chdir($conn, $val) == FALSE)
            {
                $tmp = ftp_mkdir($conn, $val);
                if ($tmp == FALSE)
                {
                    echo "目录创建失败，请检查权限及路径是否正确！";
                    exit;
                }
                ftp_chdir($conn, $val);
            }
        }
        for ($i = 1; $i == $path_div; $i++) // 回退到根
        {
            ftp_cdup($conn);
        }
//        ftp_chdir($conn, 'backend');
        $res = ftp_put($conn, '201905231420194935.png', $fileName . '/web/uploads/2019-05-23/201905231420194935.png', FTP_BINARY);
        ftp_close($conn);
        var_dump($res);
        exit;
        //第一个参数必选  第二个设置上传目录 可选  第三个 设置允许上传的扩展名  第四个 设置允许上传文件的大小
//        $upload = new Upload($file);
//        $url = $upload->upload();
//        $ftp = new Ftp('47.110.236.17', 21, 'ftpuser', 'JUFangFtp123456'); // 打开FTP连接
//        $ftp->up_file($fileName . '/web/uploads/2019-05-23/201905231420194935.png', 'upload/uploadfiles/house_images/' . date('Y-m-d') . '/201905231420194935.png'); // 上传文件
//        $ftp->move_file('a/b/c/cc.txt', 'a/cc.txt'); // 移动文件
//        $ftp->copy_file('a/cc.txt', 'a/b/dd.txt'); // 复制文件
//        $ftp->del_file('a/b/dd.txt'); // 删除文件
//        $ftp->close(); // 关闭FTP连接
    }

}
