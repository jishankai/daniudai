<!DOCTYPE html>
<html class="mobile-notes-variant bg-color-white" lang="en"><!--full-srceen-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" user-scalable="no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的贷款</title>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-precomposed-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-precomposed-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/logo-72.png">
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css?<?php echo $v; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/base.css?<?php echo $v; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/fonts.css?<?php echo $v; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/widget.css?<?php echo $v; ?>" />
</head>
<body>
	<div class="container">
		<div class="screen-content">			
			<div class="content">
				<div class="repay-box">
					<div class="repay-text">
						<div class="r-name">还款账单</div>						
						<span><!-- 5010 --><b id="bill">0</b></span>
					</div>
					<div class="repay-text last-child">
						<div class="r-name">可用金额</div>						
						<span><?php echo $range;?>&nbsp;&nbsp;/&nbsp;<em class="font-gray">10000</em></span>
					</div>
					<div id="overdue">
						<!-- <div class="repay-item">						
							<span class="money">1002元</span>
							<p>2014.04.04</p>
							<div class="r-right">
								<span class="font-red">已逾期<em>2</em>天</span>
								<span class="r-arrow"></span>
							</div>
						</div> -->
					</div>
					<div id="expire">
						<!-- <div class="repay-item">						
							<span class="money">1002元</span>
							<p>2014.04.04</p>
							<div class="r-right">
								<span class="font-green">还剩<em>2</em>天</span>
								<span class="r-arrow"></span>
							</div>
						</div> -->
					</div>
					<div id="more_day">
						<!-- <div class="repay-item">						
							<span class="money">1002元</span>
							<p>2014.04.04</p>
							<div class="r-right">
								<span class="font-gray">2015.07.30到期</span>
								<span class="r-arrow"></span>
							</div>
						</div> -->
						<?php 
							foreach($loans as $loan){
								echo '<div class="repay-item">';
									echo '<span class="money">'.$loan->money.'元</span>';
									echo '<p>2014.04.04</p>';
									echo '<div class="r-right">';
										echo '<span class="font-gray">'.$loan->start_at.'到期</span>';
										echo '<span class="r-arrow"></span>';
									echo '</div>';
								echo '</div>';
						?>

						<?php }?>
					</div>
					<div id="repay">
						<!-- <div class="repay-item">						
							<span class="money">1002元</span>
							<p>2014.04.04</p>
							<div class="r-right">
								<span class="font-gray">已还清</span>
								<span class="r-arrow"></span>
							</div>
						</div> -->
					</div>
					<div di="wait_money">
						
					</div>
					<div id="wait_review">
						
					</div>
				</div>
			</div>
		</div>
	</div>	
	<script type="text/javascript" src="js/jquery-1.11.1.js?<?php echo $v; ?>"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		 wx.config(<?php echo $js->config(array('hideOptionMenu'), false, true) ?>);
		 wx.ready(function(){
		 	wx.hideOptionMenu();
		 });


	</script>	
</body>
</html>
