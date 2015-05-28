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
					<form class="forms" id="form1">
						<div class="forms-item">
							<div class="forms__group">
			                    <label class="forms__label">姓名</label>
			                    <span class="input__box">             
			                        <input type="text" class="forms_input" placeholder="真实姓名"  id="name" name="name">
			                        <!-- onchange="javascript:if(!/^[\u4e00-\u9fa5\.]+$/gi.test(this.value))validateName();" -->
			                        <span class="icon-option"><i class="icons icons-cross"></i></span>
			                    </span>
			                </div>
			                <div class="forms__group">
			                    <label class="forms__label">学生证</label>
			                    <span class="input__box no-border">   
			                        <input type="text" class="forms_input" placeholder="学生证号" id="stu_id" name="stu_id">
			                        <span class="icon-option"><i class="icons icons-cross"></i></span>
			                    </span>
			                </div> 
		                </div>                                   
		            	<div class="forms-item">
							<!-- <div class="forms__group">
			                    <label class="forms__label">学校</label>
			                    <span class="input__box select">
			                    	<p class="d-color">学校</p>选中后去掉d-color
			                        <span class="icon-option"><i class="icons icons-arrowRright"></i></span>
			                    </span>
			                </div> -->
						
			                <div class="forms__group">
			                    <label class="forms__label">学校</label>
			                    <span class="input__box">             
			                        <input type="text" class="forms_input" placeholder="学校"  id="school-name" name="school-name">
			                        <span class="icon-option"><i class="icons icons-arrowRright"></i></span>
			                    </span>
			                </div>

			                <!-- <div class="forms__group">
			                    <label class="forms__label">专业</label>
			                    <span class="input__box select">
			                    	<p class="d-color">专业/入学年份</p>
			                        <span class="icon-option"><i class="icons icons-arrowRright"></i></span>
			                    </span>
			                </div> -->

							 <div class="forms__group">
			                    <label class="forms__label">专业</label>
			                    <span class="input__box">             
			                        <input type="text" class="forms_input" placeholder="专业/入学年份" id="major" name="major">
			                        <input type="hidden" name="degrees" value="" id="cdegrees" />
			                        <span class="icon-option"><i class="icons icons-arrowRright"></i></span>
			                    </span>
			                </div>

			                <div class="forms__group">
			                    <label class="forms__label">详细地址</label>
			                    <span class="input__box no-border">   
			                        <input type="text" class="forms_input" placeholder="宿舍楼和房间号" id="address" name="dorm">
			                        <span class="icon-option"><i class="icons icons-cross"></i></span>
			                    </span>
			                </div>
			            </div>
		                <div class="forms__option">
		                	<!-- <button class="btn btn-primary disabled btn-fullwidth">下一步</button> -->
		                	<input type="text" value="" style="display:none;" id="school_id" name="school_id"/>
		                	<input type="text" value="" style="display:none;" id="grade" name="grade">
		                	<input type="submit" class="btn btn-primary btn-fullwidth" value="下一步" id="next" disabled/>
		                </div>                                              
		            </form>
				</div>
			</div>
		</div>		
	</div>	

<div class="mask" style="position:fixed;left:0;top:0;display:none;">
	<div class="popover popover-big" style="display:block;position:relative;left:0;top:20px;" id="c_school"><!--滑动出现left:0;-->
		<div class="popover-inner">
			<div class="lists-box">					
				<div class="lists-title">
					<h3>选择高校</h3>
					<span class="close" id="close1">&times;</span>
				</div>
				<div class="lists-body">
					<ul class="lists-main" id="cschool_list">
						<li class="active"><i class="icons icons-check"></i>北京大学</li>
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
	<div class="popover popover-big" style="display:block;position:relative;left:0;top:20px;" id="c_degrees"><!--滑动出现left:0;-->
		<div class="popover-inner">
			<div class="lists-box">					
				<div class="lists-title">
					<h3>选择学历</h3>
					<span class="close" id="close2">&times;</span>
				</div>
				<div class="lists-body">
					<ul class="lists-main" id="cdegrees_list">
						<li class="active"><i class="icons icons-check"></i>本科</li>
					</ul>
					<p class="l-info">目前暂不支持研究生</p>
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
					<h3>选择院系</h3>
					<span class="close" id="close3">&times;</span>
				</div>
				<div class="lists-body">
					<ul class="lists-main" style="max-height:300px;" id="college-list"><!--max-height值跟屏幕高度有关-->
									
					</ul>
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
					<ul class="lists-main" id="cmajor_list" style="max-height:300px;">
						
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
					<ul class="lists-main" id="year_list">
						<li class="active"><i class="icons icons-check"></i>2010</li>
						<li><i class="icons icons-check"></i>2011</li>
						<li><i class="icons icons-check"></i>2012</li>
						<li><i class="icons icons-check"></i>2013</li>	
						<li><i class="icons icons-check"></i>2014</li>
						<li class="last-child"><i class="icons icons-check"></i>2015</li>			
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 请输入真实姓名 -->

<div class="popover popover-small" style="display:none;position: relative; margin-left:-90px; " id="n_validate"><!--提示消失opacity:0;显示位置margin:-20px 0 0 -90px;-->
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
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="js/person-information.js"></script>
<script type="text/javascript" src="js/change.js"></script>
<script type="text/javascript">

</script>

</html>
