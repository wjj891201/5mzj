<?php

namespace frontend\components;

use yii\authclient\OAuth2;
use yii\web\HttpException;
use Yii;

class AuthClientQq extends OAuth2
{

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://graph.qq.com/oauth2.0/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://graph.qq.com/oauth2.0/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://graph.qq.com';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->scope === null)
        {
            $this->scope = implode(' ', [
                'get_user_info',
            ]);
        }
    }

    protected function initUserAttributes()
    {
        $userAttributes = $this->api(
                'user/get_user_info', 'GET', [
            'oauth_consumer_key' => $this->user->client_id,
            'openid' => $this->user->openid
                ]
        );

        $userAttributes['id'] = $this->user->openid;
        $userAttributes['login'] = $userAttributes['nickname'];
        return $userAttributes;
    }

    /**
     * @inheritdoc
     */
    protected function getUser()
    {
        $result = file_get_contents($this->apiBaseUrl . '/oauth2.0/me?access_token=' . $this->accessToken->token);

        if (strpos($result, "callback") !== false)
        {
            $result = str_replace(['callback( ', ' );'], '', $result);
        }

        return json_decode($result);
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'qq';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'QQ';
    }

}
