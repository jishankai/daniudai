$(function(){
		wwidth=$(window).width();
		wheight=$(window).height();
		$("#c_school").css("left",-wwidth);
		$("#c_college").css("left",-wwidth);
		$("#c_degrees").css("left",-wwidth);
		$("#admission_year").css("left",-wwidth);

		$("#cschool_list").height(wheight/6*4);
		$("#cdegrees_list").height(wheight/6*4);
		$("#college-list").height(wheight/6*4);
		$("#year_list").height(wheight/6*4);

/*选择学校*/
	$("#school-name").click(function(){
		$(".mask").show();
		$(".mask").height($(window).height());
		var wheight=$(window).height();
		var cschool=$("#c_school").height();
		$("#c_school").css("top",Math.round((wheight-cschool)/2));
		$("#c_school").css("left",0);
		
		$("#cschool_list li").click(function(){
			$(this).addClass("active").siblings().removeClass();
			a=$(this).html();
			$(".mask").hide();	
			$("#school-name").html(a.substring(33));
			$("#school-name").removeClass("d-color");
		})
		$("#close1").click(function(){
			$(".mask").hide();
		})
	})

/*选择学历*/
	$("#major").click(function(){
		if($("#school-name").html()=="学校"){
			$(".mask").show();
			$(".mask").height($(window).height());
			var wheight=$(window).height();
			var cschool=$("#c_school").height();

			$("#c_school").css("top",Math.round((wheight-cschool)/2));
			$("#c_school").css("left",0);
			$("#cschool_list li").click(function(){
				$(this).addClass("active").siblings().removeClass();
				a=$(this).html();
				$(".mask").hide();	
				$("#school-name").html(a.substring(33));
				$("#school-name").removeClass("d-color");
				var school_name=$("#school-name").html();
				mclick(school_name);

			})
			$("#close1").click(function(){
				$(".mask").hide();
			})
		}else{
			var school_name=$("#school-name").html();
			mclick(school_name);
		}

		
	})/*$("#major").click 结束*/

function mclick(school_name){
	if(school_name=="北京大学"){
		 $('#cdegrees_list li').remove();
		 $('#cdegrees_list').append("<li><i class='icons icons-check'></i>本科</li>");
	}else if(school_name=="北京大学（医学部）"){
		$('#cdegrees_list li').remove();
		$('#cdegrees_list').append("<li><i class='icons icons-check'></i>本科</li>");
		$('#cdegrees_list').append("<li><i class='icons icons-check'></i>本博/本硕连读</li>");
	}
	$(".mask1").show();
		var wheight=$(window).height();
		var cdegrees=$("#c_degrees").height();
		$("#c_degrees").css("top",Math.round((wheight-cdegrees)/10));
		$("#c_degrees").css("left",0);

		$("#cdegrees_list li").click(function(){
			$(this).addClass("active").siblings().removeClass();
			ad=$(this).html();
			adgree=ad.substring(33);

			$(".mask1").hide();	
			$("#cdegrees").val(a.substring(33));

/*根据学校请求学院信息*/
			asname=$('#school-name').html();

			if(asname=="北京大学（医学部）"){
				$("#c_m").html("选择专业");
				beiyi(adgree);
			}
			if(asname=="北京大学"){
				beida(adgree);
			}

			/*选择学院*/
			$(".mask2").show();
			var wheight=$(window).height();
			var ccollege=$("#c_college").height();
			$("#c_college").css("top",Math.round(wheight/8));
			$("#c_college").css("left",0);
			$("#college-list li").click(function(){
				$(this).addClass("active").siblings().removeClass();
				b=$(this).html();
				college=b.substring(33);
					grade(college,adgree);
					/*选择入学年份*/
					$(".mask2").hide();
					$(".mask4").show();
					var wheight=$(window).height();
					var ayear=$("#admission_year").height();
					$("#admission_year").css("top",Math.round(wheight/8));
					$("#admission_year").css("left",0);

					$("#year_list li").click(function(){
						$(this).addClass("active").siblings().removeClass();
						d=$(this).html();
						admission_year=d.substring(33);
						$("#grade").val(admission_year);
						$(".mask4").hide();
						$("#major").html(college+'/'+admission_year);
						$("#major").removeClass("d-color");
	
					})/*$("#year_list li").click结束*/								
			})/*$("#college-list li").click结束*/
		})/*$("#cdegrees_list li").click结束*/
		$("#close2").click(function(){
			$(".mask1").hide();
		})
		$("#close3").click(function(){
			$(".mask2").hide();
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
	$("#pi_error").css("top",Math.round((wheight-pi_error)/6));
	$("#close7").click(function(){
		$(".mask6").hide();
	})
}

function beida(degrees){
	var school = ["数学科学学院","物理学院","化学与分子工程学院","地球与空间科学学院","城市与环境学院","生命科学学院","心理学系","环境科学与工程学院","信息科学技术学院","工学院","中国语言文学系","历史学系","考古文博学院","外国语学院","哲学系","艺术学院","国际关系学院","社会学系","法学院","经济学院","光华管理学院","信息管理系","政府管理学院","新闻与传播学院","元培学院"];
	$('#college-list li').remove();
	for(var i=0;i<school.length;i++){
	 $('#college-list').append("<li><i class='icons icons-check'></i>"+school[i]+"</li>");
	}
}
function beiyi(degrees){
	var school = ["临床医学8年制","基础医学8年制","口腔医学8年制","预防医学7年制","应用药学6年制"];
	var school1=["临床医学5年制","口腔医学5年制","生物医学英语","预防医学5年制","应用药学4年制","护理学","医学实验技术","医学检验技术","口腔医学技术"];
	
	if(degrees=="本科"){
		$('#college-list li').remove();
		for(var i=0;i<school1.length;i++){
		 $('#college-list').append("<li><i class='icons icons-check'></i>"+school1[i]+"</li>");
		}
	}
	if(degrees=="本博/本硕连读"){
		$('#college-list li').remove();
		for(var i=0;i<school.length;i++){
		 $('#college-list').append("<li><i class='icons icons-check'></i>"+school[i]+"</li>");
		}
	}
}

function grade(college,adgree){
	if(adgree=="本科"){
		$('#year_list li').remove();
		for(var i=2010;i<2015;i++){
		 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
		}
	}

	if(adgree=="本博/本硕连读"){
		if(college=="临床医学8年制" || college=="基础医学8年制" || college=="口腔医学8年制"){
			$('#year_list li').remove();
			for(var i=2007;i<2015;i++){
			 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
			}
		}
		if(college=="预防医学7年制"){
			$('#year_list li').remove();
			for(var i=2008;i<2015;i++){
			 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
			}
		}
		if(college=="应用药学6年制"){
			$('#year_list li').remove();
			for(var i=2009;i<2015;i++){
			 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
			}
		}

	}
	
}



})