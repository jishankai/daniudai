<?php

namespace frontend\controllers;

use Yii;
use Overtrue\Wechat\Auth;
use Overtrue\Wechat\Notice;
use backend\models\User; 
use backend\models\Loan; 
use backend\models\Student;
use backend\models\School;

class LoanController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionBank()
    {
        session_start();
        $user = $_SESSION['user'];
        $s = Student::findOne($user['openid']);
        $u = User::findOne($user['openid']);
        $stu_id = $_POST['stu_id'];
        $school_id = $_POST['school_id'];
        $dorm = $_POST['dorm'];
        $grade = $_POST['grade'];
        $name = $_POST['name'];

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!isset($s)) {
                $s = new Student;
                $s->wechat_id = $user['openid'];
            }
            $s->stu_id = $stu_id;
            $s->school_id = $school_id;
            $s->dorm = $dorm;
            $s->grade = $grade;
            $s->created_at = time();
            $s->save();

            $u->name = $name;
            $u->save();
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $this->renderPartial('bank', array('user'=>$u));
    }

    public function actionLend($type='common')
    {
        $rate = ($type=='common')?0.03:0.02;
        return $this->renderPartial('lend', array('rate'=>$rate));
    }

    public function actionIndex()
    {
        $appId = Yii::$app->params['wechat_appid'];
        $secret = Yii::$app->params['wechat_appsecret'];

        session_start();
        if (empty($_SESSION['user'])) {
            $auth = new Auth($appId, $secret);
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
        $money = $_REQUEST['money'];
        $duration = $_REQUEST['duration'];
        $rate = $_REQUEST['rate'];
        
        session_start();
        $user = $_SESSION['user'];
        $loan = Loan::findOne(['wechat_id'=>$user['openid']]);
        $transaction = Yii::$app->db->beginTransaction();
        try {
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
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        $student = Student::findOne($user['openid']);
        $schools = School::find()->all();

        return $this->renderPartial('school', array('student'=>$student, 'schools'=>$schools));
    }

    public function actionSuccess()
    {
        if (isset($_POST['id'])) {
            session_start();
            $user = $_SESSION['user'];
            $u = User::findOne($user['openid']);
            $id = $_POST['id'];
            $mobile = $_POST['mobile'];
            $bank = $_POST['bank'];
            $bank_id = $_POST['bank_id'];

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $u->id = $id;
                $u->mobile = $mobile;
                $u->bank = $bank;
                $u->bank_id = $bank_id;
                $u->save();
            } catch(\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }

            $appId = Yii::$app->params['wechat_appid'];
            $secret = Yii::$app->params['wechat_appsecret'];
            $notice = new Notice($appId, $secret);
            //通知放款员面签
            //通知用户协议
            //$messageId = $notice->uses($templateId)->andUrl($url)->withColor($color)->data($data)->send();
        }

        return $this->renderPartial('success');
    }

    public function actionMe()
    {
        $appId = Yii::$app->params['wechat_appid'];
        $secret = Yii::$app->params['wechat_appsecret'];

        session_start();
        if (empty($_SESSION['user'])) {
            $auth = new Auth($appId, $secret);
            $user = $auth->authorize('http://dev.imengstar.com/index.php?r=loan/me', 'snsapi_base'); // 返回用户 Bag
            $_SESSION['user'] = $user;
        }
        $user = $_SESSION['user'];

        $open_id = $user['openid'];
        if ($open_id==Yii::$app->params['pku101_supporter'] OR $open_id==Yii::$app->params['pku102_supporter']) {
            return $this->renderPartial('personal_list');
        } else if($open_id==Yii::$app->params['demo_supporter']) {
            return $this->renderPartial('bank_list', ['verification'=>'demo']);
        } else if($open_id==Yii::$app->params['admin_supporter']) {
            return $this->renderPartial('bank_list', ['verification'=>'admin']);
        } else {
            return $this->renderPartial('agreement');
        }
    }

}
