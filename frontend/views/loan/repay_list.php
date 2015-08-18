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

		 var billInput = $("#bill"),
		 	 overdue = $("$overdue"),
		 	 expire = $("expire"),
		 	 more_day = $("#more_day"),
		 	 repay = $("#repay"),
		 	 wait_money = $("#wait_money"),
		 	 wait_review = $("#wait_review"),
		 	 count=0;

		 	 var arrmoney = new Array(),
		 	 	 arrrate = new Array(),
		 	 	 arrduration = new Array(),
		 	 	 arrend = new Array(),
		 	 	 arrstart = new Array(),
		 	 	 arrstatus = new Array();

		 <?php 
		 	foreach($loans as $loan){ 
		 ?>
		 	arrmoney[<?php echo $loan->loan_id?>] = <?php echo $loan->money?>;
		 	arrrate[<?php echo $loan->loan_id?>] = <?php echo $loan->rate?>;
		 	arrduration[<?php echo $loan->loan_id?>] = <?php echo $loan->duration?>;
		 	arrend[<?php echo $loan->loan_id?>] = <?php echo $loan->end_at?>;
		 	arrstart[<?php echo $loan->loan_id?>] = <?php echo $loan->start_at?>;
		 	arrstatus[<?php echo $loan->loan_id?>] = <?php echo $loan->status?>;

		 <?php }?>
		
		/*alert(arrstatus.length);
		$("#test").html(arrstatus.length);*/
		// for(var i=0;i<arrstatus.length;i++){
		for(var key in arrstatus){
			
			var money = arrmoney[key],
				start_at = arrstart[key],
				date = NewDate(arrstart[key]),
				end_at = NewDate(arrend[key]),
				now = Date.parse(new Date())/1000,
				s_day = NewDay(arrend[key],now),
				b_l = money+money*arrrate[key]*arrduration[key];

		 	if(arrstatus[key]==1){
		 		wait_review.append("<div class='repay-item'><span class='money' id='pay_off_money'>"+money+"元</span><p id='pay_off_date'>"+date+"</p><div class='r-right'><span class='font-gray'>待审核</span><span class='r-arrow'></span></div></div>");		 		

		 	}else if(arrstatus[key]==2){
		 		wait_money.append("<div class='repay-item'><span class='money' id='pay_off_money'>"+money+"元</span><p id='pay_off_date'>"+date+"</p><div class='r-right'><span class='font-gray'>待放款</span><span class='r-arrow'></span></div></div>");
		 	}else if(arrstatus[key]==3){
		 		if(s_day>7){
		 			more_day.append("<div class='repay-item'><span class='money' id='pay_off_money'>"+money+"元</span><p id='pay_off_date'>"+date+"</p><div class='r-right'><span class='font-gray'>"+end_at+"到期</span><span class='r-arrow'></span></div></div>");
		 			count = count + b_l;
		 		}else if(s_day>0){
		 			expire.append("<div class='repay-item'><span class='money' id='pay_off_money'>"+money+"元</span><p id='pay_off_date'>"+date+"</p><div class='r-right'><span class='font-green'>还剩<em>"+s_day+"</em>天</span><span class='r-arrow'></span></div></div>");
		 			count = count + b_l;
		 		}else if(s_day==0){
		 			expire.append("<div class='repay-item'><span class='money' id='pay_off_money'>"+money+"元</span><p id='pay_off_date'>"+date+"</p><div class='r-right'><span class='font-green'><em>今天</em></span><span class='r-arrow'></span></div></div>");
		 			count = count + b_l;
		 		}else{
		 			overdue.append("<div class='repay-item'><span class='money' id='pay_off_money'>"+money+"元</span><p id='pay_off_date'>"+date+"</p><div class='r-right'><span class='font-red>已逾期<em>"+Math.abs(s_day)+"</em>天</span><span class='r-arrow'></span></div></div>");
		 			bill = Math.round((b_l + b_l * Math.abs(s_day) * 0.0004)*100)/100;
		 			count = count + bill;
		 		}
		 	}else if(arrstatus[key]==4){
		 		repay.append("<div class='repay-item'><span class='money' id='pay_off_money'>"+money+"元</span><p id='pay_off_date'>"+date+"</p><div class='r-right'><span class='font-gray'>已还清</span><span class='r-arrow'></span></div></div>");
		 	}
		}

		 billInput.html(count);


		 function NewDate(date){
		 	var dd=new Date(parseInt(date)*1000);  
		 	var y = dd.getFullYear(); 
		 	var m = (dd.getMonth()+1)<10?"0"+(dd.getMonth()+1):(dd.getMonth()+1);
		 	var d = dd.getDate()<10?"0"+dd.getDate():dd.getDate(); 
		 	return y+'.'+m+'.'+d;
		 }
		 function NewDay(date1,date2){
		 	return parseInt((parseInt(date1)-parseInt(date2))/(60*60*24));
		 }

	</script>	
</body>
</html>
