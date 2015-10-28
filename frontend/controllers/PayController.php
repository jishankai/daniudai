<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Json;
use Overtrue\Wechat\Auth;
use Overtrue\Wechat\Notice;
use Overtrue\Wechat\Staff;
use Overtrue\Wechat\Js;
use Yeepay\YeepayMPay;
use backend\models\User;
use backend\models\Loan;
use backend\models\Student;
use backend\models\School;
use backend\models\Bank;
use backend\models\Yeepay;

require_once(__DIR__ . '/../../vendor/lianlianpay/lib/llpay_notify.class.php');
require_once(__DIR__ . '/../../vendor/lianlianpay/lib/llpay_submit.class.php');

class PayController extends \yii\web\Controller
{
    public function actionRepaying()
    {

        require_once(__DIR__ . '/../../vendor/lianlianpay/llpay.config.php');

        $appId = Yii::$app->params['wechat_appid'];
        $secret = Yii::$app->params['wechat_appsecret'];

        session_start();
        if (empty($_SESSION['user'])) {
            $auth = new Auth($appId, $secret);
            $user = $auth->authorize(Url::to(['loan/repay'], TRUE), 'snsapi_base'); // 返回用户 Bag
            $_SESSION['user'] = $user;
        }

        $user = $_SESSION['user'];
        $order_id = $user['openid'].'_'.$_POST['loan_id'].'_'.date("Ymd");
        $u = User::findOne($user['openid']);

        $y = Yeepay::findOne($order_id);
        if (!isset($y)) {
            $y = new Yeepay;
            $y->order_id = $order_id;
            $y->wechat_id = $user['openid'];
            $y->loan_id = $_POST['loan_id'];
            $y->fee = $_POST['fee'];
            $y->status = 0;
            $y->created_at = time();
            $y->save();
        }

        //商户用户唯一编号
        $user_id = $user['openid'];
        //支付类型
        $busi_partner = '101001';
        //商户订单号
        $no_order = $order_id;
        //商户网站订单系统中唯一订单号，必填
        //付款金额
        $money_order = (int)$y->fee;
        //必填
        //商品名称
        $name_goods = '真牛贷-还款';
        //订单描述
        $info_order = '还款';
        //卡号
        $card_no = $u->bank_id;
        //姓名
        $acct_name = $u->name;
        //身份证号
        $id_no = $u->id;
        //注册时间
        $dt = local_date('YmdHis', $u->created_at);
        //风险控制参数
        $risk_item = "{\\\"frms_ware_category\\\":\\\"2009\\\",\\\"user_info_mercht_userno\\\":$user_id,\\\"user_info_dt_register\\\":$dt,\\\"user_info_full_name\\\":{$u->name},\\\"user_info_id_no\\\":{$u->id},\\\"user_info_identify_type\\\":\\\"1\\\",\\\"user_info_identify_state\\\":\\\"1\\\"}";
        //订单有效期
        $valid_order = 24*60;

        $notify_url = Url::to(['pay/callback'], TRUE);//商户后台系统回调地址，前后台的回调结果一样
        $return_url = Url::to(['pay/return'], TRUE);//商户前台系统回调地址，前后台的回调结果一样

        /************************************************************/

        //构造要请求的参数数组，无需改动
        $parameter = array (
            "oid_partner" => trim($llpay_config['oid_partner']),
            "app_request" => trim($llpay_config['app_request']),
            "sign_type" => trim($llpay_config['sign_type']),
            "valid_order" => trim($llpay_config['valid_order']),
            "user_id" => $user_id,
            "busi_partner" => $busi_partner,
            "no_order" => $no_order,
            "dt_order" => local_date('YmdHis', time()),
            "name_goods" => $name_goods,
            "info_order" => $info_order,
            "money_order" => $money_order,
            "notify_url" => $notify_url,
            "url_return" => $return_url,
            "card_no" => $card_no,
            "acct_name" => $acct_name,
            "id_no" => $id_no,
            "risk_item" => $risk_item,
            "valid_order" => $valid_order
        );

        //建立请求
        $llpaySubmit = new \LLpaySubmit($llpay_config);
        $html_text = $llpaySubmit->buildRequestForm($parameter, "post", "确认");
        echo $html_text;

        // $y = Yeepay::findOne($order_id);
        // if (!isset($y)) {
        //     $y = new Yeepay;
        //     $y->order_id = $order_id;
        //     $y->wechat_id = $user['openid'];
        //     $y->loan_id = $_POST['loan_id'];
        //     $y->fee = $_POST['fee'];
        //     $y->status = 0;
        //     $y->created_at = time();
        //     $y->save();
        // }
        // $u = User::findOne($user['openid']);

        // $merchantaccount = Yii::$app->params['merchant_account'];
        // $merchantPublicKey = Yii::$app->params['merchant_pub'];
        // $merchantPrivateKey = Yii::$app->params['merchant_private'];
        // $yeepayPublicKey = Yii::$app->params['yeepay_pub'];

        // $yeepay = new YeepayMPay($merchantaccount, $merchantPublicKey, $merchantPrivateKey, $yeepayPublicKey);

        // //$order_id = $this->create_str(15);//网页支付的订单在订单有效期内可以进行多次支付请求，但是需要注意的是每次请求的业务参数都要一致，交易时间也要保持一致。否则会报错“订单与已存在的订单信息不符”
        // $transtime = $y->created_at;//交易时间，是每次支付请求的时间，注意此参数在进行多次支付的时候要保持一致。
        // $product_catalog = '30';//商品类编码是我们业管根据商户业务本身的特性进行配置的业务参数。
        // $identity_id = $y->wechat_id;//用户身份标识，是生成绑卡关系的因素之一，在正式环境此值不能固定为一个，要一个用户有唯一对应一个用户标识，以防出现盗刷的风险且一个支付身份标识只能绑定5张银行卡
        // $identity_type = 2;     //支付身份标识类型码
        // $user_ip = $_SERVER["REMOTE_ADDR"];//此参数不是固定的商户服务器ＩＰ，而是用户每次支付时使用的网络终端IP，否则的话会有不友好提示：“检测到您的IP地址发生变化，请注意支付安全”。
        // $user_ua = $_SERVER['HTTP_USER_AGENT'];//用户ua
        // $product_name = '真牛贷-还款';//出于风控考虑，请按下面的格式传递值：应用-商品名称，如“诛仙-3 阶成品天琊”
        // $product_desc = '还款';//商品描述
        // $terminaltype = 3;
        // $terminalid = $y->wechat_id;//其他支付身份信息
        // $amount = (int)$y->fee;//订单金额单位为分，支付时最低金额为2分，因为测试和生产环境的商户都有手续费（如2%），易宝支付收取手续费如果不满1分钱将按照1分钱收取。
        // $cardno = $u->bank_id;
        // $idcardtype = '01';
        // $idcard = $u->id;
        // $owner = $u->name;
        // $url = $yeepay->webPay($order_id, $transtime, $amount, $cardno, $idcardtype, $idcard, $owner, $product_catalog, $identity_id, $identity_type, $user_ip, $user_ua, $callbackurl, $fcallbackurl, $currency = 156, $product_name, $product_desc, $terminaltype, $terminalid, $orderexp_date = 60);

        // $arr = explode('&', $url);
        // $encrypt = explode('=', $arr[1]);
        // $data = explode('=', $arr[2]);

        // return $this->redirect($url);
        //var_dump($url);
    }

    public function actionReturn()
    {
        require_once(__DIR__ . '/../../vendor/lianlianpay/llpay.config.php');

        $appId = Yii::$app->params['wechat_appid'];
        $secret = Yii::$app->params['wechat_appsecret'];

        //计算得出通知验证结果
        $llpayNotify = new \LLpayNotify($llpay_config);
        $verify_result = $llpayNotify->verifyReturn();
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取连连支付的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            $json = new JSON;
            $res_data = $_REQUEST["res_data"];
            //商户编号
            $oid_partner = $json->decode($res_data)['oid_partner'];
            //商户订单号	$no_order = $json->decode($res_data)['no_order'];
            //支付结果
            $result_pay =  $json->decode($res_data)['result_pay'];

            if($result_pay == 'SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（no_order）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
                $order_id = $json->decode($res_data)['no_order'];
                $y = Yeepay::findOne($order_id);
                $l = Loan::findOne($y->loan_id);
                if ($y->status==0) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        $y->status = 1;
                        $l->status = 4;
                        $y->updateAttributes(['status']);
                        $l->updateAttributes(['status']);
                        $transaction->commit();
                    } catch(\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                    }

                    $notice = new Notice($appId, $secret);
                    $templateId = Yii::$app->params['templateId_repay_success'];
                    $url = Url::to(['loan/repayed'],TRUE);
                    $data = array(
                        "first"    => "您已成功还款",
                        "keyword1" => $y->fee/100.00,
                        "keyword2" => "借款",
                        "keyword3" => "已还款",
                        "keyword4" => date("Y-m-d", $l->end_at),
                        "keyword5" => date("Y-m-d H:i:s"),
                        "remark"   => "您已还款成功，感谢您的使用！",
                    );
                    $messageId = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($l->wechat_id)->send();
                }
            } else {
                echo "result_pay=".$result_pay;
            }
            return $this->redirect(['loan/repayed']);
            //echo "验证成功<br />";

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            //如要调试，请看llpay_notify.php页面的verifyReturn函数
            return $this->redirect(['loan/repay']);
            //echo "验证失败";
        }
    }

    public function actionCallback()
    {
        require_once(__DIR__ . '/../../vendor/lianlianpay/llpay.config.php');

        $appId = Yii::$app->params['wechat_appid'];
        $secret = Yii::$app->params['wechat_appsecret'];

        //计算得出通知验证结果
        $llpayNotify = new \LLpayNotify($llpay_config);
        $llpayNotify->verifyNotify();
        if ($llpayNotify->result) { //验证成功
            //获取连连支付的通知返回参数，可参考技术文档中服务器异步通知参数列表
            $no_order = $llpayNotify->notifyResp['no_order'];//商户订单号
            $oid_paybill = $llpayNotify->notifyResp['oid_paybill'];//连连支付单号
            $result_pay = $llpayNotify->notifyResp['result_pay'];//支付结果，SUCCESS：为支付成功
            $money_order = $llpayNotify->notifyResp['money_order'];// 支付金额
            if($result_pay == "SUCCESS"){
                //请在这里加上商户的业务逻辑程序代(更新订单状态、入账业务)
                //——请根据您的业务逻辑来编写程序——
                //payAfter($llpayNotify->notifyResp);

                $order_id = $no_order;
                $y = Yeepay::findOne($order_id);
                $l = Loan::findOne($y->loan_id);
                if ($y->status==0) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        $y->status = 1;
                        $l->status = 4;
                        $y->updateAttributes(['status']);
                        $l->updateAttributes(['status']);
                        $transaction->commit();
                    } catch(\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                    }

                    $notice = new Notice($appId, $secret);
                    $templateId = Yii::$app->params['templateId_repay_success'];
                    $url = Url::to(['loan/repayed'],TRUE);
                    $data = array(
                        "first"    => "您已成功还款",
                        "keyword1" => $y->fee/100.00,
                        "keyword2" => "借款",
                        "keyword3" => "已还款",
                        "keyword4" => date("Y-m-d", $l->end_at),
                        "keyword5" => date("Y-m-d H:i:s"),
                        "remark"   => "您已还款成功，感谢您的使用！",
                    );
                    $messageId = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($l->wechat_id)->send();
                }
            }
            die("{'ret_code':'0000','ret_msg':'交易成功'}"); //请不要修改或删除
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            //验证失败
            die("{'ret_code':'9999','ret_msg':'验签失败'}");
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }

        // $merchantaccount = Yii::$app->params['merchant_account'];
        // $merchantPublicKey = Yii::$app->params['merchant_pub'];
        // $merchantPrivateKey = Yii::$app->params['merchant_private'];
        // $yeepayPublicKey = Yii::$app->params['yeepay_pub'];

        // $yeepay = new yeepayMPay($merchantaccount, $merchantPublicKey, $merchantPrivateKey, $yeepayPublicKey);
        // try {
        //     $return = $yeepay->callback($_REQUEST['data'], $_REQUEST['encryptkey']);
        //     // TODO:添加订单处理逻辑代码

        //     $order_id = $return['orderid'];
        //     $y = Yeepay::findOne($order_id);
        //     $l = Loan::findOne($y->loan_id);
        //     if ($return['status']==1 and $y->status==0) {
        //         $transaction = Yii::$app->db->beginTransaction();
        //         try {
        //             $y->status = 1;
        //             $l->status = 4;
        //             $y->updateAttributes(['status']);
        //             $l->updateAttributes(['status']);
        //             $transaction->commit();
        //         } catch(\Exception $e) {
        //             $transaction->rollBack();
        //             throw $e;
        //         }

        //         $notice = new Notice($appId, $secret);
        //         $templateId = Yii::$app->params['templateId_repay_success'];
        //         $url = Url::to(['loan/repayed'],TRUE);
        //         $data = array(
        //             "first"    => "您已成功还款",
        //             "keyword1" => $y->fee/100.00,
        //             "keyword2" => "借款",
        //             "keyword3" => "已还款",
        //             "keyword4" => date("Y-m-d", $l->end_at),
        //             "keyword5" => date("Y-m-d H:i:s"),
        //             "remark"   => "您已还款成功，感谢您的使用！",
        //         );
        //         $messageId = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($l->wechat_id)->send();
        //     }

        //     return $this->redirect(['loan/repayed']);
        // }catch (yeepayMPayException $e) {
        //     // TODO：添加订单支付异常逻辑代码
        //     return $this->redirect(['loan/repay']);
        // }
    }

}
