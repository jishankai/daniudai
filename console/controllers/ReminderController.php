<?php

namespace console\controllers;
 
use Yii;
use yii\console\Controller;
use yii\helpers\Url;
use Overtrue\Wechat\Notice;
use backend\models\Loan; 
 
class ReminderController extends Controller {
 
    public function actionIndex() {
        echo "Reminder Working...\n";

        $appId = Yii::$app->params['wechat_appid'];
        $secret = Yii::$app->params['wechat_appsecret'];

        $loans = Loan::findAll(['status'=>3]);
        foreach ($loans as $l) {
            $t = $l->end_at-time();
            if (($t<7*24*3600 and $t>=6*24*3600) or ($t<24*3600 and $t>=0)) {
                $notice = new Notice($appId, $secret);
                $templateId = Yii::$app->params['templateId_repay_remind'];
                $url = Url::to(Yii::$app->params['host'].'/index.php?r=loan/repay');
                $data = array(
                    "first"    => "您有一笔借款即将到期，请注意及时还款。",
                    "keyword1" => date("Y-m-d", $l->end_at),
                    "keyword2" => $l->money,
                    "keyword3" => $l->money*$l->rate*$l->duration,
                    "remark"   => "",
                );
                $messageId = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($l->wechat_id)->send();
            } else if ($t<0) {
                $notice = new Notice($appId, $secret);
                $templateId = Yii::$app->params['templateId_repay_remind'];
                $url = Url::to(Yii::$app->params['host'].'/index.php?r=loan/repay');
                $data = array(
                    "first"    => "您有一笔借款已经逾期，请及时还款避免产生额外的费用。",
                    "keyword1" => date("Y-m-d", $l->end_at),
                    "keyword2" => $l->money,
                    "keyword3" => $l->money*$l->rate*$l->duration.'以及逾期罚息',
                    "remark"   => "",
                );
                $messageId = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($l->wechat_id)->send();
            }
        }

        echo "Reminder Stop...\n";

    }

}
