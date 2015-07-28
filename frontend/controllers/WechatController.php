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
            if ($message->MsgType=='text') {
                if ($message->Content=='借款') {
                    return Message::make('text')->content('请点击页面左下角“申请贷款”提交个人学籍和银行卡信息完成借款申请。提交申请后，我们信贷员会在第一时间与您联系，面签确认您的身份后即可获得借款。So easy 啦！');
                } else if ($message->Content=='业务') {
                    return Message::make('text')->content('大牛贷对在校生提供1000—10000元的无抵押、纯信用贷款，利率为0.03%/日。只要是大学生，注册提交并面签通过后，最快10分钟内拿到借款。借款期限为100天、200天、300天，到期再还款。大牛贷希望你能在这段时间内自己赚钱，来还这笔钱，而不是从父母给的生活费里出。
自己的事情自己做，不伸手跟父母要钱，年轻人，你长大了。');
                } else if ($message->Content=='地区') {
                    return Message::make('text')->content('大牛贷目前仅支持北京大学（北大）本科生的借款，更多高校争取在九月份开通，需要我大牛贷的同学敬请期待，请继续关注！');
                } else if ($message->Content=='大牛君') {
                    return Message::make('text')->content('大牛君是大牛贷两位创始人的昵称，他们是北京大学2015届本科毕业生。他们在45天时间里从校友处筹集到了1000万元，将这笔钱用于大学生借款中，提供史上最低息的、无抵押无担保、纯信用的学生贷款。
年轻人，年轻的时候是要做一些牛逼的事情的，所以，我们叫大牛！');
                } else if ($message->Content=='历史消息') {
                    return Message::make('news')->items(function(){
                        return array(
                            Message::make('news_item')->title('历史消息')->description('')->url('http://mp.weixin.qq.com/mp/getmasssendmsg?__biz=MzA3ODg2NzY5Ng==#wechat_webview_type=1&wechat_redirect'),
                        );
                    });
                }
            }

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
            return Message::make('text')->content('牛仔您好！大牛贷是专门针对大学生的超低息、无担保、纯信用贷款。只要是大学生，注册提交、并面签通过审核后即可获得借款。
年轻人，能用钱解决的那都不是事，缺钱就我大牛。
                 
请回复“借款”、“业务”、“地区”、“大牛君”了解大牛贷，回复“历史消息”获取历史消息。');
        });

        $server->on('event', 'CLICK', function($event) {
            if ($event['EventKey']=='CLICK_ANSWER') {
                return Message::make('text')->content('牛仔您好！大牛贷是专门针对大学生的超低息、无担保、纯信用贷款。只要是大学生，注册提交、并面签通过审核后即可获得借款。
年轻人，能用钱解决的那都不是事，缺钱就我大牛。
                 
请回复“借款”、“业务”、“地区”、“大牛君”了解大牛贷，回复“历史消息”获取历史消息。');
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
            new MenuItem("我的贷款", 'view', Url::to(['loan/repay'], TRUE)),
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
