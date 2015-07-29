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

        $loans = Loan::findAll(['status'=>3]);
        foreach ($loans as $l) {
            $appId = Yii::$app->params['wechat_appid'];
            $secret = Yii::$app->params['wechat_appsecret'];

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
        }

        echo "Reminder Stop\n";

    }

}
