<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class IndexController extends Controller
{
    


    public function actionIndex()
    {
        return $this->render('index');
    }

    
}
