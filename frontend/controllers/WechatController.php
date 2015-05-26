<?php

namespace frontend\controllers;

use Yii;
use Overtrue\Wechat\Server;

class WechatController extends \yii\web\Controller
{
    public function actionMessage()
    {
        $appId = Yii::$app->params['wechat_appid'];
        $secret = Yii::$app->params['wechat_appsecret'];
        $token = Yii::$app->params['wechat_token'];
        $encodingAESKey = Yii::$app->params['wechat_aeskey'];

        $server = new Server($appId, $token, $encodingAESKey);

        $result = $server->serve();

        echo $result;
    }

}
