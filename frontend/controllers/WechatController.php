<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;

use backend\models\Student;

class WechatController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionMessage()
    {
        $appId = Yii::$app->params['wechat_appid'];
        $secret = Yii::$app->params['wechat_appsecret'];
        $token = Yii::$app->params['wechat_token'];
        $encodingAESKey = Yii::$app->params['wechat_aeskey'];

        $server = new Server($appId, $token, $encodingAESKey);
        $server->on('message', function($message) {
            $openid = $message['FromUserName'];
            $student = Student::findOne($openid);
            if (isset($student) AND $student->school_id>0) {
                if (floor($student->school_id/100)==101) {
                    $account = '201501@daniudai';
                } else if (floor($student->school_id/100)==102) {
                    $account = '201502@daniudai';
                } else {
                    $account = '201504@daniudai';
                }
                return Message::make('transfer')->to($account);
            } else {
                return Message::make('transfer');
            }
            //return Message::make('text')->content('儿童节就是大牛君和大家见面的日子啦，各位大牛敬请期待哦！没事可以调戏调戏客服');
        });

        $server->on('event', 'subscribe', function($event){
            return Message::make('text')->content('大牛贷学长正紧锣密鼓开张中！感谢您的关注，正式上线后我们会第一时间通知您！');
        });

        $server->on('event', 'CLICK', function($event) {
            if ($event['EventKey']=='CLICK_ANSWER') {
                return Message::make('text')->content('牛仔您来啦~有什么可以效劳的？您只需点击下方左侧#键盘#图标，用文字或说话，都可以和大牛君开说了');
            }
        });


        $result = $server->serve();

        echo $result;
    }

    public function actionSetmenu()
    {
        $appId = Yii::$app->params['wechat_appid'];
        $secret = Yii::$app->params['wechat_appsecret'];

        $menu = new Menu($appId, $secret);
        $menus = array(
            new MenuItem("申请贷款", 'view', Url::to(['loan/index'], TRUE)),
            new MenuItem("你问我答", 'click', 'CLICK_ANSWER'),
        );

        try {
            $menu->set($menus);// 请求微信服务器
            echo '设置成功！';
        } catch (\Exception $e) {
            echo '设置失败：' . $e->getMessage();
        }
    }
}
