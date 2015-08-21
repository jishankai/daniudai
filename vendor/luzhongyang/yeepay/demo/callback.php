<?php
include 'config.php';
include 'yeepay/yeepayMPay.php';
/**
*此类文件是有关回调的数据处理文件，根据易宝回调进行数据处理

*/
$yeepay = new yeepayMPay($merchantaccount, $merchantPublicKey, $merchantPrivateKey, $yeepayPublicKey);
try {
	$return = $yeepay->callback($_POST['data'], $_POST['encryptkey']);
// TODO:添加订单处理逻辑代码

	
}catch (yeepayMPayException $e) {
// TODO：添加订单支付异常逻辑代码

}
?>