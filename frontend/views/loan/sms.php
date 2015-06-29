<!DOCTYPE html>
<html class="mobile-notes-variant" lang="en"><!--full-srceen-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" user-scalable="no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>验证码</title>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-precomposed-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-precomposed-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/logo-72.png">
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/base.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/fonts.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/widget.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/attach.css" />
</head>
<body>
	<div class="container" id="container">
		<div class="screen-content">			
			<div class="content">
				<div class="info-box">	
                <div class="info-text" id="success_send"><p>验证码已发送至手机：<span id="phone"><?php echo $mobile?></span></p></div>		
					<form class="forms" onsubmit="return false;">                           
		            	<div class="forms-item">							
			                <div class="forms__group btn-right">		                    
			                    <span class="input__box no-border">
			                        <input type="tel" class="forms_input" placeholder="请输入验证码" value="" id="idCode" maxlength="6" node-type="LoanCaptchaInput">
			                    </span>
			                    <a class="code-btn" id="send" href="javascript:;" node-type="LoanSendBtn">获取验证码</a>
			                   
			                    <!--a class="code-btn" href="#">获取验证码</a-->
			                </div>                
			            </div>        
		                <div class="forms__option">
		                	<button class="btn btn-primary btn-fullwidth disabled" id="confirmBtn" node-type="LoanConfirmBtn">确定</button><!--disabled-->
		                </div>                                              
		            </form>
				</div>
			</div>
		</div>
		<div id="masker" class="masker" style="display:none;"></div>
		<div id="common_masker" class="popover popover-small" style="display:none;position: absolute; margin-left:-90px;"><!--提示消失opacity:0;显示位置margin:-20px 0 0 -90px;-->
			<div class="popover-inner">
				<div class="wrong-box">
					<p></p>				
				</div>
			</div>
		</div>
	</div>	
	
</body>
<script type="text/javascript" src="./js/libs/zepto.js"></script>
<script type="text/javascript" src="./js/widgets/tools.js"></script>
<script type="text/javascript" src="./js/widgets/MessageBox.js"></script>
<script type="text/javascript" src="./js/widgets/constants.js"></script>
<script type="text/javascript" src="./js/widgets/identifying.js"></script>
<script type="text/javascript">

		$("#container").PUB();
	
</script>	
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
     wx.config(<?php echo $js->config(array('hideOptionMenu'), false, true) ?>);
     wx.ready(function(){
         wx.hideOptionMenu();
     });
 </script>
</html>
