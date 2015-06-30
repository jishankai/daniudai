<?php use yii\helpers\Url;?>
<!DOCTYPE html>
<html class="mobile-notes-variant" lang="en"><!--full-srceen-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" user-scalable="no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>申请贷款</title>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-precomposed-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-precomposed-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/logo-72.png">
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css?<?php echo $v;?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/base.css?<?php echo $v;?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/fonts.css?<?php echo $v;?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/widget.css?<?php echo $v;?>" />
</head>
<body>
	<div class="container">
		<div class="screen-content">			
			<div class="content">
				<div class="apply-box">
					<div class="apply-info">轻松申请，快速到账，日利率：<?php echo $rate*100; ?>%</div> 
					<div class="apply-item" id="applyMoney">
						<div class="a-title">
							<h3>我要借：</h3>
							<span class="a-right"><em class="f-orange">￥3000</em></span>
						</div>
						<div class="progress-box">
							<div class="progressBar-wrap">
								<div class="progressBar" style="width:22.222%;">
									<i id="changeRecharge" class="icons icons-recharge">￥</i>
								</div>
							</div>
						</div>
					</div>
					<div class="apply-item" id="applyTime">
						<div class="a-title">
							<h3 class="f-normal">借款时间：</h3>
							<span class="a-right"><em class="f-orange">200天</em></span>
						</div>
						<div class="progress-box">
							<div class="progressBar-wrap">
								<div class="progressBar" style="width:50%;">
									<span id="changeCal" class="icons icons-calendar"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="repay-text" id="repayTmpl">
						<p></p>
						<h3>还款金额：</h3>
						<span class="r-right"><em class="f-orange">计算中</em></span>
					</div>
					<form class="forms" action="<?php echo Url::to(['loan/school'])?>" method="post">
		                <div class="forms__option">
		                	<input type="text" value="<?php echo $rate?>" style="display:none;" name="rate"/>
		                	<input type="text" value="200" style="display:none;" name="duration"/>
		                	<input type="text" value="3000" style="display:none;" name="money"/>
		                	<button class="btn btn-orange btn-fullwidth" id="applicationBtn">立即申请</button>
		                </div>                                              
		            </form>
				</div>
			</div>
		</div>
	</div>	
	<script type="text/javascript">
		var rate = '<?php echo $rate?>';
	</script>
	<script type="text/javascript" src="js/jquery-1.11.1.js?<?php echo $v;?>"></script>
	<script type="text/javascript" src="js/depend.js?<?php echo $v;?>"></script>
	<script type="text/javascript" src="js/loan.js?<?php echo $v;?>"></script>
	<script type="text/javascript">
		$(".container").Loan(); 
	</script>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
     wx.config(<?php echo $js->config(array('hideOptionMenu'), false, true) ?>);
     wx.ready(function(){
         wx.hideOptionMenu();
     });
 </script>
</html>
