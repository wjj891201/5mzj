<?php

namespace backend\controllers;

use Yii;
//use yii\web\Controller;

class HomeController extends CommonController
{

    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

    public function actionWelcome()
    {
        return "欢迎来到o2o主后台首页!";
    }

    public function actionArticle()
    {
        return $this->render('article');
    }

}
