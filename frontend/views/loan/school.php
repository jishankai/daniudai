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
			                        <input type="text" class="forms_input" placeholder="宿舍楼和房间号" id="address" name="address">
			                        <span class="icon-option"><i class="icons icons-cross"></i></span>
			                    </span>
			                </div>
			            </div>
		                <div class="forms__option">
		                	<!-- <button class="btn btn-primary disabled btn-fullwidth">下一步</button> -->
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
						<!-- <li class="active"><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>
						<li><i class="icons icons-check"></i>信息与技术工程学院</li>	
						<li class="last-child"><i class="icons icons-check"></i>物理学院</li> -->			
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
					<ul class="lists-main" id="cmajor_list">
						<!-- <li class="active"><i class="icons icons-check"></i>计算机</li>	
						<li class="last-child"><i class="icons icons-check"></i>微电子</li>	 -->		
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
<script type="text/javascript">

/*选择学校*/
	$("#school-name").click(function(){
		$(".mask").show();
		$(".mask").height($(window).height());
		var wheight=$(window).height();
		var cschool=$("#c_school").height();

		$("#c_school").css("top",Math.round((wheight-cschool)/2-10));
		$("#cschool_list li").click(function(){
			$(this).addClass("active").siblings().removeClass();
			a=$(this).html();
			$(".mask").hide();	
			$("#school-name").val(a.substring(33));
		})
		$("#close1").click(function(){
			$(".mask").hide();
		})
	})

/*选择学历*/
	$("#major").click(function(){
		if($("#school-name").val()==""){
			$(".mask").show();
			$(".mask").height($(window).height());
			var wheight=$(window).height();
			var cschool=$("#c_school").height();

			$("#c_school").css("top",Math.round((wheight-cschool)/2-10));
			$("#cschool_list li").click(function(){
				$(this).addClass("active").siblings().removeClass();
				a=$(this).html();
				$(".mask").hide();	
				$("#school-name").val(a.substring(33));
				mclick();

			})
			$("#close1").click(function(){
				$(".mask").hide();
			})
		}else{
			mclick();
		}

		
	})/*$("#major").click 结束*/

function mclick(){
	$(".mask1").show();
		var wheight=$(window).height();
		var cdegrees=$("#c_degrees").height();
		$("#c_degrees").css("top",Math.round((wheight-cdegrees)/2-10));
		$("#cdegrees_list li").click(function(){
			$(this).addClass("active").siblings().removeClass();
			a=$(this).html();
			$(".mask1").hide();	
			$("#cdegrees").val(a.substring(33));

/*根据学校请求学院信息*/
			asname=$("#school-name").val();
			$.ajax({
                    url:"http://dev.imengstar.com:8080/schools",
					data: {},
					type: "get",
					success: function (data) {
						var json_x = $.parseJSON(data);
                        for(var i=0; i<json_x.data.lenth; i++){
                            $("#college-list").append("<li><i class='icons icons-check'></i>"+json_x.data[i]+"</li>");
                        }
					}
			});/*$.ajax结束*/

			/*选择学院*/
			$(".mask2").show();
			var wheight=$(window).height();
			var ccollege=$("#c_college").height();
			$("#c_college").css("top",Math.round((wheight-ccollege)/2-10));
			$("#college-list li").click(function(){
				$(this).addClass("active").siblings().removeClass();
				b=$(this).html();
				college=b.substring(33);

				/*选择专业*/
				$(".mask2").hide();

				/*根据学院请求专业信息*/
				$.ajax({
						url:"http://www.baidu.com",
						data: {sname:college},
						type: "post",
						success: function (data) {
							var json_x = $.parseJSON(data);
							if (json_x.data.isSuccess) {
								for(var i=0; i<json_x.data.lenth; i++){
									$("#cmajor_list").append("<li><i class='icons icons-check'>"+json_x.data[i]+"</li>");
								}
							} 				
						}
				});/*$.ajax结束*/

				$(".mask3").show();
				var wheight=$(window).height();
				var cmajor=$("#c_major").height();
				$("#c_major").css("top",Math.round((wheight-cmajor)/2-10));
				$("#cmajor_list li").click(function(){
					$(this).addClass("active").siblings().removeClass();
					c=$(this).html();
					major=c.substring(33);
					$(".mask3").hide();

					/*选择入学年份*/
					$(".mask4").show();
					var wheight=$(window).height();
					var ayear=$("#admission_year").height();
					$("#admission_year").css("top",Math.round((wheight-ayear)/2-10));
					$("#year_list li").click(function(){
						$(this).addClass("active").siblings().removeClass();
						d=$(this).html();
						admission_year=d.substring(33);
						$(".mask4").hide();
						$("#major").val(major+'/'+admission_year);

						/*验证入学年份和学生证号是否匹配*/
						if($("#stu_id").val()!=""){
							stu_id=$("#stu_id").val();
							var a1=admission_year.substring(0,4);
							var b1=stu_id.substring(0,2);
							if(a1!=b1){
								error2();
							}
						}
	
					})/*$("#year_list li").click结束*/					
				})/*$("#cmajor_list li").click结束*/			
			})/*$("#college-list li").click结束*/
		})/*$("#cdegrees_list li").click结束*/
		$("#close2").click(function(){
			$(".mask1").hide();
		})
		$("#close3").click(function(){
			$(".mask2").hide();
		})
		$("#close4").click(function(){
			$(".mask3").hide();
		})
		$("#close5").click(function(){
			$(".mask4").hide();
		})

}/*function mclick()结束*/
/*个人信息验证有误*/
function error2(){
	$(".mask6").show();
	var wheight=$(window).height();
	var pi_error=$("#pi_error").height();
	$("#pi_error").css("top",Math.round((wheight-pi_error)/2-10));
	$("#close7").click(function(){
		$(".mask6").hide();
	})
}

</script>

</html>
