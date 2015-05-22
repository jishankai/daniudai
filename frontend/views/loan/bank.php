<!DOCTYPE html>
<html class="mobile-notes-variant" lang="en"><!--full-srceen-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" user-scalable="no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>填写银行信息</title>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-precomposed-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-precomposed-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/logo-72.png">
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/base.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/fonts.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/widget.css" />
<!-- attach -->
<link rel="stylesheet" type="text/css" media="all" href="css/attach.css" />
</head>
<body>
	<div class="container">
		<div class="screen-content">			
			<div class="content">
				<div class="info-box">	
					<div class="info-text"><p>请正确填写银行卡信息，以能够及时打款。</p></div>		
					<form class="forms" id="form2">				                                   
		            	<div class="forms-item">
							<!-- <div class="forms__group">
			                    <label class="forms__label">银行</label>
			                    <span class="input__box select"> 
			                    	<p class="">北京银行</p>选中后去掉d-color，默认文字：银行名称
			                        <span class="icon-option"><i class="icons icons-arrowRright"></i></span>
			                    </span>
			                </div> -->
							<div class="forms__group">
			                    <label class="forms__label">银行</label>
			                    <span class="input__box">             
			                        <input type="text" class="forms_input" placeholder="银行名称"  id="bank-name">
			                        <span class="icon-option"><i class="icons icons-arrowRright"></i></span>
			                    </span>
			                </div>

			                <div class="forms__group">
			                    <label class="forms__label">卡号</label>
			                    <span class="input__box">             
			                        <input type="text" class="forms_input" placeholder="银行卡号" value="" id="bc-num">
			                        <span class="icon-option"><i class="icons icons-cross" style="display:block;" id="i1"></i></span>
			                    </span>
			                </div>
			                <div class="forms__group">
			                    <label class="forms__label">确认卡号</label>
			                    <span class="input__box no-border"> 
			                        <input type="text" class="forms_input" placeholder="确认银行卡号"  value="" id="cbc-num">
			                        <span class="icon-option"><i class="icons icons-cross" style="display:block;" id="i2"></i></span>
			                    </span>
			                </div>
			            </div>
			            <div class="forms-item">
							<div class="forms__group">
			                    <label class="forms__label">姓名</label>
			                    <span class="input__box">                                   
			                        <input type="text" class="forms_input" placeholder="真实姓名" value="" id="name">
			                        <span class="icon-option"><i class="icons icons-cross" style="display:block;" id="i3"></i></span>
			                    </span>
			                </div>
			                <div class="forms__group">
			                    <label class="forms__label">身份证</label>
			                    <span class="input__box">           
			                        <input type="text" class="forms_input" placeholder="身份证号" value="" id="id-num">
			                        <span class="icon-option"><i class="icons icons-cross" style="display:block;" id="i4"></i></span>
			                    </span>
			                </div> 
			                <div class="forms__group">
			                    <label class="forms__label">手机号</label>
			                    <span class="input__box no-border">   
			                        <input type="text" class="forms_input" placeholder="预留在银行的手机号"  id="phone-num">
			                        <span class="icon-option"><i class="icons icons-cross"style="display:block;" id="i5"></i></span>
			                    </span>
			                </div> 
		                </div>
		                <div class="forms__option">
		                	<!-- <button class="btn btn-primary btn-fullwidth">下一步</button> -->
		                	<input type="submit" class="btn btn-primary btn-fullwidth" value="下一步" disabled id="next2" />
		                	<p class="option-text">点击下一步，意味着您同意<a href="#">《借款协议》</a></p>
		                </div>                                              
		            </form>
				</div>
			</div>
		</div>
	</div>	

<!-- 选择银行名称 -->
<div class="mask7" style="position:fixed;left:0;top:0;display:none;">
	<div class="popover popover-big" style="display:block;position: relative;left:0;" id="c_bank">
		<div class="popover-inner">
			<div class="lists-box">					
				<div class="lists-title">
					<h3>选择银行</h3>
					<span class="close" id="close8">&times;</span>
				</div>
				<div class="lists-body" id="cbank-list">
					<ul class="lists-main" id="year_list">
						<li class="active"><i class="icons icons-check"></i>北京银行</li>	
						<li class="last-child"><i class="icons icons-check"></i>招商银行</li>			
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 请输入真实姓名 -->

<div class="popover popover-small" style="display:none;position: relative; margin-left:-90px; " id="validate"><!--提示消失opacity:0;显示位置margin:-20px 0 0 -90px;-->
	<div class="popover-inner">
		<div class="wrong-box">
			<p id="error"></p>				
		</div>
	</div>
</div> 

<!-- 当前身份信息已被占用 -->
<div class="mask8" style="position:fixed;left:0;top:0;display:none;">
	<div class="popover" style="display:block;position: relative;" id="error3">
		<div class="popover-inner">
			<div class="message-box">
				<p>当前身份信息已被占用，如有疑问，请在微信里联系客服。</p>			
				<a href="#" class="btn-option" id="e3-close">我知道了</a> 		
			</div>
		</div>
	</div> 
</div>

</body>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="js/bank-information.js"></script>
<script type="text/javascript">

	
</script>
</html>
