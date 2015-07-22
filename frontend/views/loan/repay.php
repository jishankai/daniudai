<!DOCTYPE html>
<html class="mobile-notes-variant bg-color-white" lang="en"><!--full-srceen-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" user-scalable="no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>贷款详情</title>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-precomposed-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-precomposed-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/logo-72.png">
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/base.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/fonts.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/widget.css" />
</head>
<body>
	<div class="container">
		<div class="screen-content">			
			<div class="content">
				<div class="repay-box">	
					<div class="repay-text">
                        <div class="r-name">到期还款日<?php echo $l->end_at?></div>
						<div class="r-time font-green">还剩2天</div>
						<!--div class="r-time font-red">已逾期2天</div>
						<div class="r-time font-gray">还剩2天</div-->
						<span>2015.07.02</span>
					</div>
					<div class="repay-text">
						<div class="r-name">应还总额</div>						
						<span class="r-money">1002&nbsp;元</span>
						<div class="r-money-s">
                            本金<span class="s-money"><?php echo $l->money?></span>
						</div>
						<div class="r-money-s">
                            利息<span class="s-money"><?php echo $l->rate*100?>%</span>
						</div>
						<div class="r-money-s">
							罚息<span class="s-money">0</span><!--font-red-->
						</div>
					</div>
					<div class="repay-text">
                        <div class="r-name">借款日期<?php echo $l->start_at?></div>						
						<span>2015.04.13</span>
					</div>
					<div class="repay-text">
						<div class="r-name">周期</div>						
                        <span><?php echo $l->duration?>&nbsp;天</span>
					</div>					
	                <div class="repay-btn">
	                	<button class="btn btn-orange btn-fullwidth">立刻还款</button>
	                </div>
	                <p class="repay-xy"><a href="#">查看《借款协议》</a></p>
				</div>
			</div>
		</div>
	</div>	
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		 wx.config(<?php echo $js->config(array('hideOptionMenu'), false, true) ?>);
		 wx.ready(function(){
		 	wx.hideOptionMenu();
		 });

	</script>	
</body>
</html>
