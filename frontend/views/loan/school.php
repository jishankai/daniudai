<?php use yii\helpers\Url;?>
<!DOCTYPE html>
<html class="mobile-notes-variant" lang="en"><!--full-srceen-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" user-scalable="no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>填写个人信息</title>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-precomposed-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-precomposed-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/logo-72.png">
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css?<?php echo $v; ?>"/>
<link rel="stylesheet" type="text/css" media="all" href="css/base.css?<?php echo $v; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/fonts.css?<?php echo $v; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/widget.css?<?php echo $v; ?>" />
<!-- attach -->
<link rel="stylesheet" type="text/css" media="all" href="css/attach.css" />
</head>
<body>
	<div class="container" id="container">
		<div class="screen-content">			
			<div class="content">
				<div class="info-box">				
					<form class="forms" id="form1" action='<?php echo Url::to(["loan/bank"])?>' method='post'>
						<div class="forms-item">
							<div class="forms__group">
			                    <label class="forms__label">姓名</label>
			                    <span class="input__box">             
			                        <input type="text" class="forms_input" placeholder="真实姓名"  id="name" name="name">
			      
			                        <span class="icon-option"><i class="icons icons-cross"></i></span>
			                    </span>
			                </div>
			                <div class="forms__group">
			                    <label class="forms__label">学生证</label>
			                    <span class="input__box no-border">   
			                        <input type="tel" class="forms_input" placeholder="学生证号" id="stu_id" name="stu_id">
			                        <span class="icon-option"><i class="icons icons-cross"></i></span>
			                    </span>
			                </div> 
		                </div>                                   
		            	<div class="forms-item">
							<div class="forms__group">
			                    <label class="forms__label">学校</label>
			                    <span class="input__box select">
			                    	<p class="d-color" id="school-name">学校</p>
			                        <span class="icon-option"><i class="icons icons-arrowRright"></i></span>
			                    </span>
			                </div>
			                <div class="forms__group">
			                    <label class="forms__label">专业</label>
			                    <span class="input__box select">
			                    	<p class="d-color" id="major">专业/入学年份</p>
			                        <span class="icon-option"><i class="icons icons-arrowRright"></i></span>
			                    	<p id="dtype" style="display:none"><?php echo $from ?></p>
			                    </span>
			                </div>

			                <div class="forms__group">
			                    <label class="forms__label">详细地址</label>
			                    <span class="input__box no-border">   
			                        <input type="text" class="forms_input" placeholder="宿舍楼和房间号" id="address" name="dorm" maxlength="100">
			                        <span class="icon-option"><i class="icons icons-cross"></i></span>
			                    </span>
			                </div>
			            </div>
			            <div class="forms-item">							
			                <div class="forms__group">
			                    <label class="forms__label">学校邮箱</label>
			                    <span class="input__box no-border input-mail">   
			                        <input type="text" class="forms_input" placeholder="邮箱地址">
			                        <span class="mail">@examplee.edu.cn</span>
			                        <span class="icon-option"><i class="icons icons-cross"></i></span>
			                    </span>
			                </div> 
		                </div> s
		                <div class="forms__option">
		                	<input type="text" value="" style="display:none;" id="grade" name="grade"/>
		                	<input type="text" value="10101" style="display:none;" id="school_id" name="school_id"/>                	
		                	<input type="text" value="" style="display:none;" id="adgree"/>
		                	<input type="button" class="btn btn-primary btn-fullwidth" value="下一步" id="next" disabled/>
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
		<div id="message_masker" class="popover" style="display:none;position:absolute;top:20%;">
			<div class="popover-inner">
				<div class="message-box">
					<p></p>			
					<a href="javascript:;" id="confirmBtn" class="btn-option">确定</a> 		
				</div>
			</div>
		</div>	
		<div id="loading_masker"class="popover popover-tiny" style="display:none;position: absolute;"><!--提示消失opacity:0;蒙层加上这个class  masker-60-->
			<div class="popover-inner">
				<img src="img/loader4.gif" id="loadingImg">
			</div>
		</div> 	
	</div>	

<div class="mask" style="position:fixed;left:0;top:0;display:none;">
	<div class="popover popover-big" style="display:block;position:relative;" id="c_school"><!--滑动出现left:0;-->
		<div class="popover-inner">
			<div class="lists-box">					
				<div class="lists-title">
					<h3>选择高校</h3>
					<span class="close" id="close1">&times;</span>
				</div>
				<div class="lists-body" id="cschool_list">
					<ul class="lists-main">
						<li><i class="icons icons-check"></i>北京大学</li>
						<li class="last-child"><i class="icons icons-check"></i>北京大学（医学部）</li>	
					</ul>
					<p class="l-info">即将开放更多大学，敬请期待！</p>
				</div>
		   	</div>
		</div>
	</div>
</div>

<!-- 学历 -->
<div class="mask1" style="position:fixed;left:0;top:0;display:none;">
	<div class="popover popover-big" style="display:block;position:relative;left:0;" id="c_degrees"><!--滑动出现left:0;-->
		<div class="popover-inner">
			<div class="lists-box">					
				<div class="lists-title">
					<h3>选择学历</h3>
					<span class="close" id="close2">&times;</span>
				</div>
				<div class="lists-body" id="cdegrees_list">
					<ul class="lists-main">
						<!-- <li><i class="icons icons-check"></i>本科</li> -->
					</ul>
					<p class="l-info"><!-- 目前暂不支持研究生 --></p>
				</div>
		   	</div>
		</div>
	</div>
</div>

<!-- 院系 -->
<div class="mask2" style="position:fixed;left:0;top:0;display:none;">
	<div class="popover popover-big" style="display:block;position: relative;left:0;" id="c_college"><!--height值为屏幕高度减去上下边距之和（60px），根据屏幕自动适应-->
		<div class="popover-inner">
			<div class="lists-box">					
				<div class="lists-title">
					<h3 id="c_m">选择院系</h3>
					<span class="close" id="close3">&times;</span>
				</div>
				<div class="lists-body" id="college-list">
					<ul class="lists-main" style="border-bottom:0;">
					</ul>
					<p class="l-info"></p>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- 选择专业 -->
<div class="mask3" style="position:fixed;left:0;top:0;display:none;">
	<div class="popover popover-big" style="display:block;position: relative;left:0;" id="c_major">
		<div class="popover-inner">
			<div class="lists-box">					
				<div class="lists-title">
					<h3>选择专业</h3>
					<span class="close" id="close4">&times;</span>
				</div>
				<div class="lists-body">
					<ul class="lists-main" id="cmajor_list">
						
					</ul>						
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 选择入学年份 -->
<div class="mask4" style="position:fixed;left:0;top:0;display:none;">
	<div class="popover popover-big" style="display:block;position: relative;left:0;" id="admission_year">
		<div class="popover-inner">
			<div class="lists-box">					
				<div class="lists-title">
					<h3>选择入学年份</h3>
					<span class="close" id="close5">&times;</span>
				</div>
				<div class="lists-body">
					<ul class="lists-main" id="year_list" style="border-bottom:0;">				
					</ul>
					<p class="l-info"></p>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 请输入真实姓名 -->

<div class="popover popover-small" style="display:none;position: absolute; margin-left:-90px; " id="n_validate"><!--提示消失opacity:0;显示位置margin:-20px 0 0 -90px;-->
	<div class="popover-inner">
		<div class="wrong-box">
			<p id="error">请输入真实姓名</p>				
		</div>
	</div>
</div> 

<!-- 个人信息有误 -->
<div class="mask6" style="position:fixed;left:0;top:0;display:none;">
	<div class="popover" style="display:block;position: relative;" id="pi_error">
		<div class="popover-inner">
			<div class="message-box m-icon">
				<p><i class="icons icons-info"></i>个人信息有误，请特别注意&nbsp;学生证和专业/入学年份是否一致。<em>请认证核查</em></p>			
				<a href="#" class="btn-option" id="close7">返回修改</a> 		
			</div>
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
<script type="text/javascript" src="js/jquery-1.11.1.js?<?php echo $v; ?>"></script>
<script type="text/javascript" src="js/person-information.js?<?php echo $v; ?>"></script>
<script type="text/javascript" src="js/change.js?<?php echo $v; ?>"></script>
<script type="text/javascript" src="js/widgets/MessageBox.js?<?php echo $v; ?>"></script>
<script type="text/javascript" src="js/widgets/tools.js?<?php echo $v; ?>"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
     wx.config(<?php echo $js->config(array('hideOptionMenu'), false, true) ?>);
     wx.ready(function(){
         wx.hideOptionMenu();
     });
 </script>

</html>
