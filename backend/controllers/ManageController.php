<?php

namespace backend\controllers;

use Yii;

class ManageController extends CommonController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}
