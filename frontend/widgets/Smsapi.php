<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//include_once('Httpclient.php');
//include_once('Thread.php');

class Smsapi{
	private  $corp_id = '5c6q001';
	private  $corp_pwd = 'drffcd';
	private  $corp_service = '10690909yd';
	public function __construct(){
		// if(REDISSWITCH){
		// 	$this->redis = new Redis();
		// 	$this->redis->connect(REDIS_IP,REDIS_PORT);
		// }
	}

	public function sendMsg($phone, $msg) {
		$data['corp_id'] = $this->corp_id;
      	$data['corp_pwd'] = $this->corp_pwd;
      	$data['corp_service'] = $this->corp_service;
      	$data['mobile'] = $phone;
      	$data['msg_content'] = $msg;
      	
      	//$result = HttpClient::quickPost('http://211.103.155.246:8080/sms_send2.do', $data);
      	
      	// if(REDISSWITCH){
      	if(0){
			$this->redis->select(1);
      		$this->redis->lPush('sms',json_encode($data,true));
      		$result = $this->postMsg();
      	}else{
      		$data['msg_content'] = iconv("utf-8", "gbk", $data['msg_content']);
      		//$result = initCurl('http://service5.baiwutong.com:8080/sms_send2.do', $data);
      		//$result = HttpClient::quickPost('http://service5.baiwutong.com:8080/sms_send2.do', $data);
			$result = $this->postRequest("http://service5.baiwutong.com:8080/sms_send2.do",$data);
      	}
      	if(strstr($result,'0#')){
      		$response = array('code'=>1, 'rspmsg'=>'sendsms OK');
      	}else{
      		$response = array('code'=>0, 'rspmsg'=>'sendsms fail');
      	}
      	return $response;
	}	
	
	public function postMsg(){
		$result = '';
		try {
			$this->redis->select(1);
			while ($sms = $this->redis->rPop('sms')){
				try {
					$rsms = json_decode($sms, true);
	      			$rsms['msg_content'] = iconv("utf-8", "gbk", $rsms['msg_content']);
	      			$time1 = $this->getMillisecond();
	      			//$result = HttpClient::quickPost('http://service5.baiwutong.com:8080/sms_send2.do', $rsms);
					/**
					$thread = new Threadrun("http://service5.baiwutong.com:8080/sms_send2.do",$rsms);
					if($thread->start()){
						$thread->join();
					}
					**/
					$result = $this->postRequest("http://service5.baiwutong.com:8080/sms_send2.do",$rsms);
	      			$time2 = $this->getMillisecond();
	      			log_message('debug','sendsms OK:'.$result.'----time:'.($time2-$time1));
	      			sleep(0.1);//延迟100毫秒
				} catch (Exception $e) {
					log_message('error','sendsms error:');
					continue;
				}
      		}
		} catch (Exception $e) {
			log_message('error','sendsms error:');
		}
		return $result;
	}
	
	private  function getMillisecond()
	{
		list($s1, $s2) = explode(' ', microtime());
		return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
	}

	/**
	 * 发起一个mob免费短信验证post请求到指定接口
	 *
	 * @param string $api 请求的接口
	 * @param array $params post参数
	 * @param int $timeout 超时时间
	 * @return string 请求结果
	 */
	private  function postRequest( $api,$params = array(), $timeout = 30 ) {
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $api );
		// 以返回的形式接收信息
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		// 设置为POST方式
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $params ) );
		// 不验证https证书
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
		curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/x-www-form-urlencoded;charset=GBK',
			'Accept: application/json',
		) );
		// 发送数据
		$response = curl_exec( $ch );
		// 不要忘记释放资源
		curl_close( $ch );
		return $response;
	}
}

