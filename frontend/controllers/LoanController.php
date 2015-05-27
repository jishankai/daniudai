<?php

namespace frontend\controllers;

use Yii;
use Overtrue\Wechat\Auth;
use backend\models\User; 

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
        if (empty($_SESSION['user'])) {
            $user = $auth->authorize('http://dev.imengstar.com/index.php?r=loan/index', 'snsapi_base', 'STATE'); // 返回用户 Bag
            $_SESSION['user'] = $user;
        } else {
            $user = $_SESSION['user'];
        }
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
            if (!isset($l) or $l->status!=0) {
                $this->redirect('loan/success');
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
