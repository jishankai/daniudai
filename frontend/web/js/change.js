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
		$("#stu_id,#name").blur();
		$(".mask").css({height:"100%"}).show();	
		var wheight=$(window).height();
		var cschool=$("#cschool_list").height();
		$("#c_school").css("top",Math.round(cschool/7));
		$("#c_school").css("left",0);
		
		$("#cschool_list ul li").click(function(){
			$(this).addClass("active").siblings().removeClass("active");
			a=$(this).html();
			$(".mask").hide();	
			$("#school-name").html(a.substring(33));
			var s_name=$("#school-name").html();
				if(s_name=="北京大学"){
					$("#suffix").html("pku");
				}else if(s_name=="北京大学（医学部）"){
					$("#suffix").html("bjmu");
				}else if(s_name=="清华大学"){
					$("#suffix").html("tsinghua");
				}else if(s_name=="中国人民大学"){
					$("#suffix").html("ruc");
				}else if(s_name=="北京师范大学"){
					$("#suffix").html("bnu");
				}else if(s_name=="浙江大学"){
					$("#suffix").html("zju");
				}
			$("#school-name").removeClass("d-color");

			$("#major").html("专业/入学年份");
			$("#major").addClass("d-color");
			$("#c_school").css("left",-wwidth);//左推动画重置
		})
		$("#close1").click(function(){
			$(".mask").hide();
			$("#c_school").css("left",-wwidth);
		})
	})

/*选择学历*/
	$("#major").click(function(){
		if($("#school-name").html()=="学校"){
			$("#stu_id,#name").blur();
			$(".mask").css({height:"100%"}).show();
			var wheight=$(window).height();
			var cschool=$("#cschool_list").height();

			$("#c_school").css("top",Math.round(cschool/7));
			$("#c_school").css("left",0);
			$("#cschool_list ul li").click(function(){
				$(this).addClass("active").siblings().removeClass();
				a=$(this).html();
				$(".mask").hide();	
				$("#school-name").html(a.substring(33));
				var s_name=$("#school-name").html();
				if(s_name=="北京大学"){
					$("#suffix").html("pku");
				}else if(s_name=="北京大学（医学部）"){
					$("#suffix").html("bjmu");
				}else if(s_name=="清华大学"){
					$("#suffix").html("tsinghua");
				}else if(s_name=="中国人民大学"){
					$("#suffix").html("ruc");
				}else if(s_name=="北京师范大学"){
					$("#suffix").html("bnu");
				}else if(s_name=="浙江大学"){
					$("#suffix").html("zju");
				}
				$("#school-name").removeClass("d-color");
				$("#c_school").css("left",-wwidth);//左推动画重置
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
	if(school_name=="北京大学" || school_name=="中国人民大学" || school_name=="北京师范大学" || school_name=="浙江大学" || school_name=="清华大学"){
		 $('#cdegrees_list ul li').remove();
		 $('#cdegrees_list ul').append("<li><i class='icons icons-check'></i>本科</li>");
		 $('#cdegrees_list ul').append("<li class='last-child'><i class='icons icons-check'></i>研究生</li>");
		 $('#cdegrees_list p').html("");
	}else if(school_name=="北京大学（医学部）"){
		$('#cdegrees_list ul li').remove();
		$('#cdegrees_list ul').append("<li><i class='icons icons-check'></i>本科</li>");
		$('#cdegrees_list ul').append("<li><i class='icons icons-check'></i>本博/本硕连读</li>");
		$('#cdegrees_list ul').append("<li class='last-child'><i class='icons icons-check'></i>研究生</li>");
		$('#cdegrees_list p').html("");
	}
	$("#stu_id,#name").blur();
	 $(".mask1").css({height:"100%"}).show();

		var wheight=$(window).height();
		var cdegrees=$("#cdegrees_list").height();
		$("#c_degrees").css("top",Math.round(cdegrees/7));
		$("#c_degrees").css("left",0);

		$("#cdegrees_list ul li").click(function(){
			$(this).addClass("active").siblings().removeClass();
			ad=$(this).html();
			adgree=ad.substring(33);
			$("#adgree").val(adgree);

			$(".mask1").hide();	
			$("#cdegrees").val(a.substring(33));

			$("#c_degrees").css("left",-wwidth);//左推动画重置
/*根据学校请求学院信息*/
			asname=$('#school-name').html();

			if(asname=="北京大学（医学部）"){
				$("#c_m").html("选择专业");
				beiyi(adgree);
			}else if(asname=="北京大学"){
				beida(adgree);
			}else if(asname=="北京师范大学"){
				shida(adgree);
			}else if(asname=="中国人民大学"){
				renda(adgree);
			}else if(asname=="清华大学"){
				qinghua(adgree);
			}else if(asname=="浙江大学"){
				zheda(adgree);
			}

			/*选择学院*/
			$("#stu_id").blur();
			$("#name").blur();
			$(".mask2").height(wheight);
			$(".mask2").show();
			var wheight=$(window).height();
			var ccollege=$("#college-list").height();
			$("#c_college").css("top",Math.round(ccollege/7));
			$("#c_college").css("left",0);
			$("#college-list ul li").click(function(){
				$(this).addClass("active").siblings().removeClass();
				b=$(this).html();
				college=b.substring(33);
					dtype=$("#dtype").html();
					grade(college,adgree,dtype);
					/*选择入学年份*/
					$(".mask2").hide();
					$(".mask4").show();
					var wheight=$(window).height();
					var ayear=$("#year_list").height();
					$("#admission_year").css("top",Math.round(ayear/7));
					$("#admission_year").css("left",0);

					$("#c_college").css("left",-wwidth);//左推动画重置

					$("#year_list li").click(function(){
						$(this).addClass("active").siblings().removeClass();
						d=$(this).html();
						admission_year=d.substring(33);
						$("#grade").val(admission_year);
						$(".mask4").hide();
						$("#major").html(college+'/'+admission_year);
						$("#major").removeClass("d-color");
						$("#admission_year").css("left",-wwidth);//左推动画重置

						var ipt=$("input");
						for(var i=0; i<ipt.length; i++){
							if($(ipt[i]).val().length == 0){		
								return false;
							}
						}
						/*if($("#next").hasClass("disabled")) return false;*/
						$("#next").removeAttr("disabled");
	
					})/*$("#year_list li").click结束*/								
			})/*$("#college-list li").click结束*/
		})/*$("#cdegrees_list li").click结束*/
		$("#close2").click(function(){
			$(".mask1").hide();
			$("#c_degrees").css("left",-wwidth);//左推动画重置
		})
		$("#close3").click(function(){
			$(".mask2").hide();
			$("#c_college").css("left",-wwidth);//左推动画重置
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
  var school1 = ["城市与环境学院","城市与环境学院","法学院","工学院","光华管理学院","国际关系学院","化学与分子工程学院","环境科学与工程学院","经济学院","考古文博学院","历史学系","社会学系","生命科学学院","数学科学学院","外国语学院","物理学院","心理学系","新闻与传播学院","信息管理系","信息科学技术学院","艺术学院","元培学院","哲学系","政府管理学院","中国语言文学系","软件与微电子学院"];
	
	if(degrees=="本科"){
		$('#college-list ul li').remove();
		for(var i=0;i<school.length;i++){
		 	$('#college-list ul').append("<li><i class='icons icons-check'></i>"+school[i]+"</li>");
		}
	}else if(degrees=="研究生"){
		$('#college-list ul li').remove();
		for(var i=0;i<school1.length;i++){
		 	$('#college-list ul').append("<li><i class='icons icons-check'></i>"+school1[i]+"</li>");
		}
	}
}
function beiyi(degrees){
	var school = ["临床医学8年制","基础医学8年制","口腔医学8年制","预防医学7年制","应用药学6年制"];
	var school1=["临床医学5年制","口腔医学5年制","生物医学英语","预防医学5年制","应用药学4年制","护理学","医学实验技术","医学检验技术","口腔医学技术"];
	var school2=["基础医学院","药学院","公共卫生学院","护理学院","医学人文研究院","北京大学第一医院","北京大学人民医院","北京大学第三医院","北京大学口腔医院","北京大学肿瘤医院","北京大学第六医院","北京大学首钢医院","北京大学国际医院","北京积水潭医院","卫生部北京医院","北京世纪坛医院","卫生部中日友好医院","北京航天中心医院","北京地坛医院","北京民用航空总医院","首都儿科研究所","北京京煤集团总医院","北京仁和医院","解放军306医院","解放军302医院","北京回龙观医院"];

	if(degrees=="本科"){
		$('#college-list ul li').remove();
		for(var i=0;i<school1.length;i++){
		 $('#college-list ul').append("<li><i class='icons icons-check'></i>"+school1[i]+"</li>");
		}
	}else if(degrees=="本博/本硕连读"){
		$('#college-list ul li').remove();
		for(var i=0;i<school.length;i++){
		 $('#college-list ul').append("<li><i class='icons icons-check'></i>"+school[i]+"</li>");
		}
	}else if(degrees=="研究生"){
		$('#college-list ul li').remove();
		for(var i=0;i<school2.length;i++){
		 $('#college-list ul').append("<li><i class='icons icons-check'></i>"+school2[i]+"</li>");
		}
	}
}
function renda(degrees){
	var school = ["环境学院","信息学院","哲学院","文学院","历史学院","艺术学院","外国语学院","新闻学院","农业与农村发展学院","社会与人口学院","公共管理学院","信息资源管理学院","财政金融学院","统计学院","商学院","劳动人事学院","法学院","马克思主义学院","国际关系学院","国学院","经济学院","理学院·心理学系","理学院·化学系","理学院·物理学系"];
	var school1 = ["环境学院","信息学院","哲学院","文学院","历史学院","艺术学院","外国语学院","新闻学院","农业与农村发展学院","社会与人口学院","公共管理学院","信息资源管理学院","财政金融学院","统计学院","商学院","劳动人事学院","法学院","马克思主义学院","国际关系学院","国学院","经济学院","理学院·心理学系","理学院·化学系","理学院·物理学系","教育学院","汉青研究院"];
	
	if(degrees=="本科"){
		$('#college-list ul li').remove();
		for(var i=0;i<school.length;i++){
		 	$('#college-list ul').append("<li><i class='icons icons-check'></i>"+school[i]+"</li>");
		}
	}else if(degrees=="研究生"){
		$('#college-list ul li').remove();
		for(var i=0;i<school1.length;i++){
		 	$('#college-list ul').append("<li><i class='icons icons-check'></i>"+school1[i]+"</li>");
		}
	}
}

function qinghua(degrees){
	var school = ["建筑学院","土木水利学院","环境学院","机械工程学院","电机工程与应用电子技术系","信息科学技术学院","交叉信息研究院","航天航空学院","工程物理系","化学工程系","材料学院","理学院","生命科学学院","医学院","生物医学工程系","北京协和医学院","经济管理学院","人文学院","社会科学学院","法学院","新闻与传播学院"];
	var school1 = ["建筑学院","土木水利学院","环境学院","机械工程学院","电子工程与应用电子技术系","信息科学技术学院","交叉信息研究院","航天航空学院","工程物理系","化学工程系","材料学院","理学院","生命科学学院","医学院","生物医学工程系","北京协和医学院","经济管理学院","人文学院","社会科学学院","法学院","新闻与传播学院"];
	
	if(degrees=="本科"){
		$('#college-list ul li').remove();
		for(var i=0;i<school.length;i++){
		 	$('#college-list ul').append("<li><i class='icons icons-check'></i>"+school[i]+"</li>");
		}
	}else if(degrees=="研究生"){
		$('#college-list ul li').remove();
		for(var i=0;i<school1.length;i++){
		 	$('#college-list ul').append("<li><i class='icons icons-check'></i>"+school1[i]+"</li>");
		}
	}
}
function shida(degrees){
	var school = ["教育学部","哲学与社会学学院","经济与工商管理学院","法学院","心理学院","体育与运动学院","文学院","外国语言文学学院","艺术与传媒学院","历史学院","数学科学学院","物理学系","化学学院","天文系","地理学与遥感科学学院","环境学院","资源学院","生命科学学院","信息科学与技术学院","政府管理学院","国家基础学科拔尖学生 培养试验计划"];
	var school1 = ["哲学与社会学学院","经济与工商管理学院","马克思主义学院","教育学部","法学院","政府管理学院","心理学院","脑与认知科学研究院","体育与运动学院","文学院","外国语言文学学院","历史学院","古籍与传统文化研究院","经济与资源管理研究院","数学科学学院","物理学系","核科学与技术学院","信息科学与技术学院","化学学院","天文系","地理学与遥感科学学院","环境学院","生命科学学院","资源学院","社会发展与公共政策学院/中国社会管理研究院","系统科学学院","全球变化与地球系统科学研究院","减灾与应急管理研究院/地表过程与资源生态国家重点实验室","艺术与传媒学院","水科学研究院","刑事法律科学研究院","汉语文化学院","国民核算研究院"];
	
	if(degrees=="本科"){
		$('#college-list ul li').remove();
		for(var i=0;i<school.length;i++){
		 	$('#college-list ul').append("<li><i class='icons icons-check'></i>"+school[i]+"</li>");
		}
	}else if(degrees=="研究生"){
		$('#college-list ul li').remove();
		for(var i=0;i<school1.length;i++){
		 	$('#college-list ul').append("<li><i class='icons icons-check'></i>"+school1[i]+"</li>");
		}
	}
}
function zheda(degrees){
	var school = ["人文学院","外国语言文化与国际交流学院","传媒与国际文化学院","经济学院","光华法学院","教育学院","管理学院","公共管理学院","数学科学学院","物理学系","化学系","地球科学学院","心理与行为科学系","机械工程学院","材料科学与工程学院","能源工程学院","电气工程学院","建筑工程学院","化学工程与生物工程学院","航空航天学院","高分子科学与工程学系","海洋学院","光电科学与工程学院","信息与电子工程学院","控制科学与工程学院","计算机科学与技术学院","生物医学工程与仪器科学学院","软件学院","生命科学学院","生物系统工程与食品科学学院","环境与资源学院","农业与生物技术学院","动物科学学院","医学院","药学院"];
	var school1 = ["人文学院","材料科学与工程学院","传媒与国际文化学院","地球科学学院","电气工程学院","动物科学学院","高分子科学与工程学系","公共管理学院","管理学院","光电科学与工程学院","光华法学院","海洋学院","航空航天学院","化学工程与生物工程学院","化学系","环境与资源学院","机械工程学院","计算机科学与技术学院","建筑工程学院","教育学院","经济学院","控制科学与工程学院","能源工程学院","农业与生物技术学院","软件学院","生命科学学院","生物系统工程与食品科学学院","生物医学工程与仪器科学学院","数学科学学院","外国语言文化与国际交流学院","物理学系","心理与行为科学系","信息与电子工程学院","药学院","医学院"];
	
	if(degrees=="本科"){
		$('#college-list ul li').remove();
		for(var i=0;i<school.length;i++){
		 	$('#college-list ul').append("<li><i class='icons icons-check'></i>"+school[i]+"</li>");
		}
	}else if(degrees=="研究生"){
		$('#college-list ul li').remove();
		for(var i=0;i<school1.length;i++){
		 	$('#college-list ul').append("<li><i class='icons icons-check'></i>"+school1[i]+"</li>");
		}
	}
}

function grade(college,adgree,dtype){
	if(adgree=="本科" && dtype=="common"){
		$('#year_list li').remove();
		for(var i=2011;i<2015;i++){
		 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
		}
	}else{
		$('#year_list li').remove();
		for(var i=2011;i<2012;i++){
		 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
		}
	}

	if(adgree=="研究生"){
		$('#year_list li').remove();
		for(var i=2011;i<2016;i++){
		 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
		}
	}

	if(adgree=="本博/本硕连读" && dtype=="common"){
		if(college=="临床医学8年制" || college=="基础医学8年制" || college=="口腔医学8年制"){
			$('#year_list li').remove();
			for(var i=2008;i<2015;i++){
			 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
			}
		}
		if(college=="预防医学7年制"){
			$('#year_list li').remove();
			for(var i=2009;i<2015;i++){
			 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
			}
		}
		if(college=="应用药学6年制"){
			$('#year_list li').remove();
			for(var i=2010;i<2015;i++){
			 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
			}
		}

	}else{
		if(college=="临床医学8年制" || college=="基础医学8年制" || college=="口腔医学8年制"){
			$('#year_list li').remove();
			for(var i=2007;i<2008;i++){
			 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
			}
		}
		if(college=="预防医学7年制"){
			$('#year_list li').remove();
			for(var i=2008;i<2009;i++){
			 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
			}
		}
		if(college=="应用药学6年制"){
			$('#year_list li').remove();
			for(var i=2009;i<2010;i++){
			 $('#year_list').append("<li><i class='icons icons-check'></i>"+i+"</li>");
			}
		}
	}

	
}




})
