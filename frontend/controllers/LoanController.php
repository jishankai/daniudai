<?php

namespace frontend\controllers;

use Yii;
use Overtrue\Wechat\Auth;
use backend\models\User; 
use backend\models\Loan; 
use backend\models\School;

class LoanController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionBank()
    {
        session_start();
        $user = $_SESSION['user'];
        $u = User::findOne($user['openid']);

        return $this->renderPartial('bank', array('user'=>$u));
    }

    public function actionLend($type='common')
    {
        $rate = ($type=='common')?0.03:0.02;
        return $this->renderPartial('lend', array('rate'=>$rate));
    }

    public function actionIndex()
    {
        $appid = Yii::$app->params['wechat_appid'];
        $appsecret = Yii::$app->params['wechat_appsecret'];

        session_start();
        if (empty($_SESSION['user'])) {
            $auth = new Auth($appid, $appsecret);
            $user = $auth->authorize('http://dev.imengstar.com/index.php?r=loan/index', 'snsapi_base'); // 返回用户 Bag
            $_SESSION['user'] = $user;
        }
        $user = $_SESSION['user'];
        
        $open_id = $user['openid'];

        $u = User::findOne($open_id);
        if (!isset($u)) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $u = new User;
                $u->wechat_id = $open_id;
                $u->name = '';
                $u->id = '';
                $u->mobile = 0;
                $u->bank = '';
                $u->bank_id = 0;
                $u->created_at = time();
                $u->save();
                $transaction->commit();
            } catch(\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        } else {
            $l = Loan::findOne($open_id);
            if (isset($l) and $l->status!=0) {
                return $this->redirect(['loan/success']);
            }
        }
        
        return $this->renderPartial('index');
    }

    public function actionSchool()
    {
        $money = $_POST['money'];
        $duration = $_POST['duration'];
        $rate = $_POST['rate'];
        
        session_start();
        $user = $_SESSION['user'];
        $loan = Loan::findOne(['wechat_id'=>$user['openid']]);
        if (isset($loan) AND $loan->status=0) {
            $loan->money = $money;
            $loan->duration = $duration;
            $loan->rate = $rate;
            $loan->start_at = time();
            $loan->end_at = time()+$duration*3600*24;
        } else {
            $loan = new Loan;
            $loan->wechat_id = $user['openid'];
            $loan->money = $money;
            $loan->duration = $duration;
            $loan->rate = $rate;
            $loan->status = 0;
            $loan->start_at = time();
            $loan->end_at = time()+$duration*3600*24;
            $loan->created_at = time();
        }
        $loan->save();

        $school = School::findOne($user['openid']);

        return $this->renderPartial('school', array('school'=>$school));
    }

    public function actionSuccess()
    {
        return $this->renderPartial('success');
    }

}
