<?php

namespace frontend\controllers;

use Yii;
use Overtrue\Wechat\Auth;
use backend\models\User; 
use backend\models\Loan; 

class LoanController extends \yii\web\Controller
{
    public function actionBank()
    {
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

        $auth = new Auth($appid, $appsecret);
        if (!isset($_GET['code']) AND empty($_SESSION['user'])) {
            $url = $auth->url('http://dev.imengstar.com/index.php?r=loan/index', 'snsapi_base'); // 返回用户 Bag
        }
        if (empty($_SESSION['user'])) {
            $_SESSION['user'] = $auth->user();
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
        $user = $_SESSION['user'];
        $school = School::findOne($user['openid']);

        return $this->renderPartial('school', array('school'=>$school));
    }

    public function actionSuccess()
    {
        return $this->renderPartial('success');
    }

}
