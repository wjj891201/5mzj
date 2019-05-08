<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

/**
 * UserController
 */
class UserController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public static function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();
        $email = ArrayHelper::getValue($attributes, 'email');
        $id = ArrayHelper::getValue($attributes, 'id');
        $nickname = ArrayHelper::getValue($attributes, 'login');

        yii::info($email, 'qq-successCallback-email');
        yii::info($id, 'qq-successCallback-id');
        yii::info($nickname, 'qq-successCallback-nickname');
    }

}
