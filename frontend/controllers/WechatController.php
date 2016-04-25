<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;
use Overtrue\Wechat\QRCode;

use backend\models\Student;
use backend\models\Qr;

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
                if ($message->Content=='1') {
                    return Message::make('text')->content('请点击页面左下角“申请贷款”提交个人学籍和银行卡信息完成借款申请。提交申请后，我们信贷员会在第一时间与您联系，面签确认您的身份后即可获得借款。So easy 啦！');
                } else if ($message->Content=='2') {
                    return Message::make('text')->content('真牛贷对在校生提供1000-10000元的无抵押、纯信用贷款，利率为0.03%/日。只要是大学生，注册提交并面签通过后，最快10分钟内拿到借款。借款期限为100天、200天、300天，到期再还款。');
                } else if ($message->Content=='3') {
                    return Message::make('text')->content('真牛贷已经开通：
北京大学
清华大学
人民大学
北京师范大学
浙江大学
北京航空航天大学
对外经贸大学
北京理工大学
哈尔滨工业大学
我们会走到每一所城市，需要我真牛贷的同学敬请期待，请继续关注！
');
                } else if ($message->Content=='4') {
                    return Message::make('text')->content('逾期1天后产生罚息，罚息为“本金+利息”*0.05%/天，并收取逾期管理费，为““本金+利息”*0.02%/天”。【逾期】超过14天真牛贷会酌情将借款人信息提供给人民银行征信系统，会【影响借款人征信】情况，且借且珍惜。');
                } else if ($message->Content=='5') {
                    return Message::make('text')->content('真牛君是真牛贷两位创始人的昵称，他们是北京大学2015届本科毕业生。他们起初从校友处筹集到了1000万元（目前累积筹款5000万元），将这笔钱用于大学生借款中，提供低息、无抵押无担保、纯信用的学生贷款。
年轻人，年轻的时候是要做一些牛逼的事情的，所以，我们叫真牛！');
                } else if ($message->Content=='8') {
                    return Message::make('news')->items(function(){
                        return array(
                            Message::make('news_item')->title('历史消息')->description('')->url('http://mp.weixin.qq.com/mp/getmasssendmsg?__biz=MzA3ODg2NzY5Ng==#wechat_webview_type=1&wechat_redirect'),
                        );
                    });
                } else if ($message->Content=='6') {
                    return Message::make('text')->content('目标大学的学生会获得10000元的额度，按需借款。10000元可一次性也可分次借满，如（3000+1000+2000+4000）。借你所需，找真牛！');
                } else if ($message->Content=='7') {
                    return Message::make('text')->content('点击下方“我的——我的贷款”进入到您的贷款列表中，可查看每次借款详情和到期时间。点击“立刻还款”就可以还款啦~');
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
            //return Message::make('text')->content('儿童节就是真牛君和大家见面的日子啦，各位真牛敬请期待哦！没事可以调戏调戏客服');
        });

        $server->on('event', 'subscribe', function($event){
            if (isset($event['EventKey'])) {
                $qr = new Qr;
                $qr->wechat_id = $event['FromUserName'];
                $qr->scene = $event['EventKey'];
                $qr->created_at = $event['CreateTime'];
                $qr->save();
            }
            return Message::make('text')->content('哈喽，等您很久了，非常欢迎您的到来。真牛贷是专门针对大学生的超低息、无抵押无担保、纯信用贷款。您的身份就是最好的信用！只要是目标大学学生，注册提交、并面签通过审核后即可获得借款。
年轻人，能用钱解决的那都不是事，缺钱就找真牛。
 
详细咨询请点击屏幕右下角“你问我答”或直接在对话框输入问题。');
        });

        $server->on('event', 'CLICK', function($event) {
            if ($event['EventKey']=='CLICK_ANSWER') {
                return Message::make('text')->content('您好，真牛贷客服为您解答各种问题，包括：借款、业务、支持地区、违约等等。请直接回复以下序号获取答案：
 
1.如何借款
2.真牛贷业务
3.借款支持学校
4.违约怎么处理
5.真牛君是谁？
6.10000元额度怎么理解？
7.我的贷款何时到期，怎么还款？
8.查看历史消息');
            } elseif ($event['EventKey']=='CLICK_OVERSEAS_STUDY_LOAN') {

                return Message::make('image')->media_id('_ofQW2y0X_reCuxGEnhcw5Bowh7VTC_Awr0Ya3CQjunazOxtBvqqiwjP9w-cAJVc');
            }
        });

        $result = $server->serve();

        echo $result;
    }

    public function actionMenu()
    {
        $appId = Yii::$app->params['wechat_appid'];
        $secret = Yii::$app->params['wechat_appsecret'];

        $menu = new Menu($appId, $secret);
        $loan = new MenuItem('申请贷款');
        $b = new MenuItem('我的');
        $menus = array(
            $loan->buttons([
                new MenuItem("我要贷款", 'view', Url::to(['loan/index'], TRUE)),
                new MenuItem("留学贷款", 'click', 'CLICK_OVERSEAS_STUDY_LOAN')
            ]),

            $b->buttons([
                new MenuItem("我的贷款", 'view', Url::to(['loan/repays'], TRUE)),
                new MenuItem("我的密码", 'view', Url::to(['loan/auth'], TRUE)),
            ]),
            new MenuItem("你问我答", 'click', 'CLICK_ANSWER'),
        );

        try {
            $menu->set($menus);// 请求微信服务器
            echo '设置成功！';
        } catch (\Exception $e) {
            echo '设置失败：' . $e->getMessage();
        }
    }

    public function actionQrcode($scene_id)
    {
        $appId = Yii::$app->params['wechat_appid'];
        $secret = Yii::$app->params['wechat_appsecret'];

        $qrcode = new QRCode($appId, $secret);

        $result = $qrcode->forever((int)$scene_id);

        $ticket = $result->ticket; // 或者 $result['ticket']

        return $this->redirect($qrcode->show($ticket));
    }
}
