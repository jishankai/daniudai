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
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/base.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/fonts.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/widget.css" />
<!-- range -->
<link rel="stylesheet" type="text/css" media="all" href="css/range.css"/>

</head>
<body>
	<div class="container">
		<div class="screen-content">			
			<div class="content">
				<div class="apply-box">
					<div class="apply-item">
						<div class="a-title">
							<h3>我要借：</h3>
							<span class="a-right"><em class="f-orange">￥<span id="lend-num">1</span>000</em></span>
						</div>
						<div class="progress-box">
							<!-- <div class="progressBar-wrap">
								<div class="progressBar" style="width:67%;">
									<i class="icons icons-recharge">￥</i>
								</div>
							</div> -->
							<div class="range-wrap">
								<input type="range" name="points" min="1" max="10" value="1" class="range" id="lend-range" onchange="aa()" />
								<div id="range-color1" class="range-color"></div>
							</div>
						</div>
					</div>
					<div class="apply-item">
						<div class="a-title">
							<h3 class="f-normal">借款时间：</h3>
							<span class="a-right"><em class="f-orange"><span id="lend-time">1</span>00天</em></span>
						</div>
						<div class="progress-box">
							<!-- <div class="progressBar-wrap">
								<div class="progressBar" style="width:33%;">
									<i class="icons icons-calendar"></i>
								</div>
							</div> -->
							<div class="range-wrap">
								<input type="range" name="points" min="1" max="4" value="1" class="range" id="lend-time-range" onchange="bb()" />
								<div id="range-color2" class="range-color"></div>
							</div>
						</div>
					</div>
					<div class="repay-text">
						<h3>还款金额：</h3>
                        <span class="r-right"><em class="f-orange">￥<span id="return-num"><?php echo 1000*(1+$rate)?></span></em></span>
					</div>
					<form class="forms">
		                <div class="forms__option">
		                	<button class="btn btn-orange btn-fullwidth">立即申请</button>
		                </div>                                              
		            </form>
				</div>
			</div>
		</div>
	</div>	
</body>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript">
	function aa(){
		
		var rangeValue = $("#lend-range").val();
		$("#lend-num").html(rangeValue);
		ww=$("#lend-range").width();
		abc=$("#lend-num").html();
	
	   $("#range-color1").width((abc-1)*(ww/9));
	   $("#lend-num2").html($("#lend-num").html()*1000);
	   $("#return-num").html($("#lend-num").html()*1000+$("#lend-num").html()*1000*$("#lend-time").html()*<?php echo $rate?>);
	}

	function bb(){
		var lendTime = $("#lend-time-range").val();
		$("#lend-time").html(lendTime);
		ww=$("#lend-time-range").width();
		abc=$("#lend-time").html();
	
	   $("#range-color2").width((abc-1)*(ww/3));
	   $("#lend-time2").html($("#lend-time").html());
	   $("#return-num").html($("#lend-num").html()*1000+$("#lend-num").html()*1000*$("#lend-time").html()*<?php echo $rate?>);
	}
</script>
</html>
