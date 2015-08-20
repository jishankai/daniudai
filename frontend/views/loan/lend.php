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
		                	<input type="text" value="<?php echo $is_auth?>" name="is_auth" style="display:none;">
		                	<a class="btn btn-orange btn-fullwidth" id="apply_btn">立即申请</a>
		                	<button class="btn btn-orange btn-fullwidth" id="applicationBtn" style="display:none">立即申请</button>
		                </div>                                              
		            </form>
				</div>
			</div>
		</div>
		<div id="masker" class="masker" style="display:none;"></div>
		<div class="popover" style="display:none;margin:0;width:90%;margin-left:5%;top:15%;" id="pwdBox">
			<div class="popover-inner">
				<div class="message-box">
					<span class="close-btn" id="psd_close">&times;</span>
					<p>输入密码，使用历史借款信息</p>
					<div class="psd-box">
						<input type="password" tabindex="1" autofocus="autofocus" name="payPassword_rsainput" id="payPassword_rsainput" class="psd-input sixDigitPassword" oncontextmenu="return false" onpaste="return false" oncopy="return false" oncut="return false" autocomplete="off" value="" maxlength="6" minlength="6" style="outline: none; margin-left: -519px;">
						<div id="sixDigitPassword" class="sixDigitPassword clearfix" tabindex="0"><!--focus-->
							<i style="border-left-width: 0px;"><b data-type="h" style="visibility: hidden;"></b></i>
							<i><b data-type="h" style="visibility: hidden;"></b></i>
							<i><b data-type="h" style="visibility: hidden;"></b></i>
							<i><b data-type="h" style="visibility: hidden;"></b></i>
							<i><b data-type="h" style="visibility: hidden;"></b></i>
							<i><b data-type="h" style="visibility: hidden;"></b></i>
						</div>
						<span id="error" style="color:red;"></span>
						<a class="forget-btn font-gray clearfix">忘记密码</a>
			        </div>
					<a href="#" class="btn-option"> 					
						<button class="btn btn-orange btn-fullwidth" id="pwd_btn">下一步</button>	
					</a>	
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
	<script type="text/javascript" src="js/widgets/tools.js?<?php echo $v?>"></script>
	<script type="text/javascript" src="js/widgets/tools.js?<?php echo $v; ?>"></script>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
     wx.config(<?php echo $js->config(array('hideOptionMenu'), false, true) ?>);
     wx.ready(function(){
         wx.hideOptionMenu();
     });
     $(".container").Loan(); 
		document.getElementById("sixDigitPassword").onclick = function(){
			document.getElementById("payPassword_rsainput").focus();
		}
		
		document.getElementById("payPassword_rsainput").onkeyup = function(e){
			var val = this.value,
				len = val.length,
				e = event || window.event || arguments.callee.caller.arguments[0],
				keycode = e.keyCode;
				
			this.value=this.value.replace(/\D/g,'');
			console.log(this.value);
			if(isNaN(val))	return false;
			
			if(keycode == 8){
				$('[data-type="v"]').last().css({visibility: "hidden"}).attr("data-type", "h");
			} else {
				$('[data-type="h"]').first().css({visibility: "visible"}).attr("data-type", "v");
			}
		}
		$("#psd_close").click(function(){
			$("#masker").hide();
			$("#pwdBox").hide();
		})

		$("#apply_btn").click(function(){
			if(<?php echo $is_auth?>==1){
				$("#masker").show();
				$("#pwdBox").show();
			}else{
				$("#applicationBtn").click();
			}
		})
		var pwdBtn=$("#pwd_btn");
		$("#pwd_btn").click(function(){
			if(pwdBtn.hasClass("disabled")) return false;
			pwdBtn.addClass('disabled');
			var pwd=$("#payPassword_rsainput").val();
			TOOLS.ajax({
				url:"./index.php?r=loan/password&type=3",
				data:{input_pwd:pwd},
				type:"post",
				dataType:"json",
				fnSuccess:function(data){
					if(data.stat=="1"){	
						$("#applicationBtn").click();
					}else if(data.stat=="2"){
						pwdBtn.removeClass('disabled');
						$("#error").html("密码错误");
					}
				},
				fnError:function(XMLHttpRequest,textstatus,errorThrown){
					alert(XMLHttpRequest.status);
					alert(XMLHttpRequest);
					alert(XMLHttpRequest.readystate);
					alert(textstatus);
				}
			});
		})
 </script>
</html>
