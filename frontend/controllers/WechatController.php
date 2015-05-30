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
            return Message::make('text')->content('牛仔您来啦~大牛贷是校友帮校友的信用贷款服务。
6月1日-6月30日，在北京大学和北京大学医学部火热进行：
1）应届本科毕业生专属，超低日利率：0.01%
2）非毕业在校本科生，特惠日利率：0.02%
要用钱，凭信用，找大牛！');
        });

        $server->on('event', 'CLICK', function($event) {
            if ($event['EventKey']=='CLICK_ANSWER') {
                return Message::make('text')->content('牛仔您来啦~有什么可以效劳的？您只需点击下方左侧小键盘图标，用文字或语音，就可以和大牛君说话了');
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
