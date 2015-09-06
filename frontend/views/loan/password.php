<!DOCTYPE html>
<html class="mobile-notes-variant" lang="en"><!--full-srceen-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" user-scalable="no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设置密码</title>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-precomposed-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-precomposed-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/logo-72.png">
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css?<?php echo $v; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/base.css?<?php echo $v; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/fonts.css?<?php echo $v; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/widget.css?<?php echo $v; ?>" />
</head>
<body>
	<div class="container" id="container">
		<div class="screen-content">			
			<div class="content">
				<div class="info-box">
					<form class="forms" onsubmit="return false;">
						<div class="forms-item forms-psdNew" id="opwdBox" style="display:none">
							<div class="forms__group" >
			                    <label class="forms__label">原密码</label>
			                    <span class="input__box no-border">             
			                        <input type="password" class="forms_input" placeholder="输入原有密码" value="" maxlength="6" id="ogn_pwd" node-type="LoanOpwdInput">	
			                    </span>
			                    <a class="f-right-btn font-gray" href="./index.php?r=loan/auth">忘记了<i class="icons icons-arrowRright"></i></a>
			                </div>
		                </div> <!--修改密码之原始密码的代码-->
						<div class="forms-item forms-psdNew">
							<div class="forms__group">
			                    <label class="forms__label" id="new_pwd">输入密码</label>
			                    <span class="input__box">             
			                        <input type="password" class="forms_input" placeholder="6位数字" value="" maxlength="6" id="set_
			                        pwd" node-type="LoanSpwdInput">	
			                    </span>
			                </div>
			                <div class="forms__group">
			                    <label class="forms__label" id="new_cfm">再次输入</label>
			                    <span class="input__box no-border">             
			                        <input type="password" class="forms_input" placeholder="6位数字" value="" maxlength="6" id="cf_pwd" node-type="LoanCpwdInput">
			                    </span>
			                </div>
		                </div> 
		                <div class="info-text" id="info_text"><p>下次借只需要输入密码。</p></div>
		                <div class="forms__option">
		                	<button class="btn btn-primary disabled btn-fullwidth" id="next">设置</button>
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
        <div id="s_x" style="display:none;"><?php echo $type?></div>		
	</div>	
</body>

<script type="text/javascript" src="js/libs/zepto.js?<?php echo $v; ?>"></script>
<script type="text/javascript" src="js/widgets/password.js?<?php echo $v; ?>"></script>
<script type="text/javascript" src="js/widgets/tools.js?<?php echo $v; ?>"></script>
<script type="text/javascript" src="js/widgets/MessageBox.js?<?php echo $v; ?>"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$("#container").PUC();
wx.config(<?php echo $js->config(array('hideOptionMenu'), false, true) ?>);
wx.ready(function(){
    wx.hideOptionMenu();
});
</script>	
</html>
