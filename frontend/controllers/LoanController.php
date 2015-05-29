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
        $rate = ($type=='common')?0.0002:0.0001;
        return $this->renderPartial('lend', ['v'=>Yii::$app->params['assets_version'], 'rate'=>$rate]);
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
        
        return $this->renderPartial('index',['v'=>Yii::$app->params['assets_version']]);
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
            $student = Student::findOne($user['openid']);
            $s = School::findOne($student->school_id);
            $message = "大牛君呐，又一位大牛来了，他叫{$u->name}，借款{$l->money}元，借{$l->duration}天，手机号{$u->mobile}，专业{$s->depart}年级{$student->grade}，请快速约起来~ ".Url::to(['loan/me'],TRUE);
            $student = Student::findOne($user['openid']);
            if (floor($student->school_id/100)==101) {
                $supporter_openid = Yii::$app->params['pku101_supporter'];
            } else if (floor($student->school_id/100)==102) {
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
            $r = Yii::$app->db->createCommand('SELECT u.name,u.mobile,s.depart, l.loan_id FROM user u LEFT JOIN loan l ON u.wechat_id=l.wechat_id LEFT JOIN student stu ON u.wechat_id=stu.wechat_id LEFT JOIN school s ON stu.school_id=s.school_id WHERE stu.school_id LIKE ":school_prefix%" AND l.status=1')->bindValue(':school_prefix',101)->queryAll();
            return $this->renderPartial('personal_list',['r'=>$r]);
        } else if($open_id==Yii::$app->params['pku102_supporter']) {
            $r = Yii::$app->db->createCommand('SELECT u.name,u.mobile,s.depart, l.loan_id FROM user u LEFT JOIN loan l ON u.wechat_id=l.wechat_id LEFT JOIN student stu ON u.wechat_id=stu.wechat_id LEFT JOIN school s ON stu.school_id=s.school_id WHERE stu.school_id LIKE ":school_prefix%" AND l.status=1')->bindValue(':school_prefix',102)->queryAll();
            return $this->renderPartial('personal_list',['r'=>$r]);
        } else if($open_id==Yii::$app->params['demo_supporter']) {
            $r = Yii::$app->db->createCommand('SELECT u.name,u.bank,u.bank_id, l.status FROM user u LEFT JOIN loan l ON u.wechat_id=l.wechat_id WHERE l.status=2')->queryAll();
            return $this->renderPartial('bank_list', ['verification'=>'demo','r'=>$r]);
        } else if($open_id==Yii::$app->params['admin_supporter']) {
            $r = Yii::$app->db->createCommand('SELECT u.name,u.bank,u.bank_id,l.loan_id FROM user u LEFT JOIN loan l ON u.wechat_id=l.wechat_id WHERE l.status=2')->queryAll();
            return $this->renderPartial('bank_list', ['verification'=>'admin','r'=>$r]);
        } else {
            return $this->renderPartial('agreement');
        }
    }

    public function actionPerson($loan_id)
    {
        session_start();
        $user = $_SESSION['user'];
        $open_id = $user['openid'];
        if ($open_id==Yii::$app->params['pku101_supporter'] OR $open_id==Yii::$app->params['pku102_supporter']) {
            $r = Yii::$app->db->createCommand('SELECT l.loan_id,l.duration,l.money,u.name,u.stu_id,u.depart,u.mobile FROM loan l LEFT JOIN user u ON l.wechat_id=u.wechat_id WHERE l.loan_id=:loan_id')->bindValue(':loan_id',$loan_id)->queryRow();
            return $this->renderPartial('personnal_details', ['r'=>$r]);
        } else {
            return $this->renderPartial('404');
        }
        
    }

    public function actionOperate($loan_id, $operation=-1)
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
        if (($operation==-1 OR $operation==2) AND ($open_id==Yii::$app->params['pku101_supporter'] OR $open_id==Yii::$app->params['pku102_supporter'])) {
            $l = Loan::findOne($loan_id);
            $u = User::findOne($l->wechat_id);
            $l->status = $operation;
            $l->updateAttributes(['status']);

            $staff = new Staff($appId, $secret);
            if ($operation==2) {
                $message = "又一位大牛通过审核:姓名:{$u->name},银行类别:{$u->bank},银行卡号:{$u->bank_id},借款额{$l->money}元,手机:{$u->mobile},请尽快汇出。".Url::to(['loan/me'],TRUE);
                $messagetoclient = "大牛您好!您的借款申请已通过审核,借款额为 {$l->money} 元 ,借款期限为 {$l->duration} 天,我们会在 24 小时内给您汇款,请耐心等待。";
                $staff->send($message)->to(Yii::$app->params['demo_supporter']);
                $staff->send($message)->to(Yii::$app->params['admin_supporter']);
                $staff->send($messagetoclient)->to($l->wechat_id);
            } else if ($operation==3 AND $open_id==Yii::$app->params['admin_supporter']) {
                $l = Loan::findOne($loan_id);
                $u = User::findOne($l->wechat_id);
                $l->status = $operation;
                $l->updateAttributes(['status']);

                $staff = new Staff($appId, $secret);
                $bank_id = substr($u->bank_id, -4);
                $messagetoclient = "大牛您好,您申请的借款已汇入您尾号为{$bank_id}的银行卡中,请及时查看。";
                $staff->send($messagetoclient)->to($l->wechat_id);
            }
        }
        
        return $this->redirect(['loan/me']);
    }
}
