<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use Overtrue\Wechat\Auth;
use Overtrue\Wechat\Notice;
use Overtrue\Wechat\Staff;
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
            $u->updateAttributes(['name']);
            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $this->renderPartial('bank', array('user'=>$u));
    }

    public function actionLend($type='common')
    {
        $rate = ($type=='common')?0.0001:0.0002;
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
                $u->mobile = '';
                $u->bank = '';
                $u->bank_id = '';
                $u->created_at = time();
                $u->save();
                $transaction->commit();
            } catch(\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        } else {
            $l = Loan::findOne(['wechat_id'=>$open_id]);
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
            $transaction->commit();
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
            $l = Loan::findOne(['wechat_id'=>$user['openid']]);
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
                $l->status = 1;
                $l->updateAttributes(['status']);
                $transaction->commit();
            } catch(\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }

            $appId = Yii::$app->params['wechat_appid'];
            $secret = Yii::$app->params['wechat_appsecret'];
            $staff = new Staff($appId, $secret);
            //通知放款员面签
            $message = "大牛君呐，又一位大牛来了，他叫{$u->name}，借款{$l->money}元，借{$l->duration}天，手机号{$u->mobile}，专业年级{student->grade}，请快速约起来~ ".Url::to(['loan/me'],TRUE);
            $student = Student::findOne($user['openid']);
            if ($student->school_id/10000==101) {
                $supporter_openid = Yii::$app->params['pku101_supporter'];
            } else if ($student->school_id/10000==102) {
                $supporter_openid = Yii::$app->params['pku102_supporter'];
            }
            $staff->send($message)->to($supporter_openid);
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
        if ($open_id==Yii::$app->params['pku101_supporter']) {
            $r = Yii::$app->db->createCommand('SELECT u.name,u.mobile,s.depart FROM user u LEFT JOIN loan l ON u.wechat_id=l.wechat_id LEFT JOIN student stu ON u.wechat_id=stu.wechat_id LEFT JOIN school s ON stu.school_id=s.school_id WHERE stu.school_id LIKE ":school_prefix%" AND l.status=1')->bindValue(':school_prefix',101)->queryAll();
            return $this->renderPartial('personal_list',['r'=>$r]);
        } else if($open_id==Yii::$app->params['pku102_supporter']) {
            $r = Yii::$app->db->createCommand('SELECT u.name,u.mobile,s.depart FROM user u LEFT JOIN loan l ON u.wechat_id=l.wechat_id LEFT JOIN student stu ON u.wechat_id=stu.wechat_id LEFT JOIN school s ON stu.school_id=s.school_id WHERE stu.school_id LIKE ":school_prefix%" AND l.status=1')->bindValue(':school_prefix',102)->queryAll();
            return $this->renderPartial('personal_list',['r'=>$r]);
        } else if($open_id==Yii::$app->params['demo_supporter']) {
            $r = Yii::$app->db->createCommand('SELECT u.name,u.bank,u.bank_id FROM user u LEFT JOIN loan l ON u.wechat_id=l.wechat_id WHERE l.status=2')->queryAll();
            return $this->renderPartial('bank_list', ['verification'=>'demo','r'=>$r]);
        } else if($open_id==Yii::$app->params['admin_supporter']) {
            $r = Yii::$app->db->createCommand('SELECT u.name,u.bank,u.bank_id FROM user u LEFT JOIN loan l ON u.wechat_id=l.wechat_id WHERE l.status=2')->queryAll();
            return $this->renderPartial('bank_list', ['verification'=>'admin','r'=>$r]);
        } else {
            return $this->renderPartial('agreement');
        }
    }

}
