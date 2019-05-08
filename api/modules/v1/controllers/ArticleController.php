<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;

class ArticleController extends Controller
{

    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator'   => [
                'class'       => CompositeAuth::className(),
                'authMethods' => [
                    ['class' => HttpBearerAuth::className()],
                    ['class' => QueryParamAuth::className(), 'tokenParam' => 'accessToken'],
                ]
            ],
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::className()
            ],
        ]);
    }


    public function actionList()
    {
//        1/0;
        return [[1 => 'qqq'], [2 => 'qwwww'], [3 => 'wqwqwqwq']];
    }

}
