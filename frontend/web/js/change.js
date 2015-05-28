$(function(){

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
			asname=$('#school-name').val();

			if(asname=="北京大学（医学部）"){
				s1="101";
				beiyi();
			}
			if(asname=="北京大学"){
				s1="102";
				beida();
			}

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

				BeiyiMajor(college);

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
					s3(major);
					$(".mask4").show();
					var wheight=$(window).height();
					var ayear=$("#admission_year").height();
					$("#admission_year").css("top",Math.round((wheight-ayear)/2-10));
					$("#year_list li").click(function(){
						$(this).addClass("active").siblings().removeClass();
						/*alert("1"+s1+s2+s3);*/
						$("#school_id").val("1"+s1+s2+s3);
						d=$(this).html();
						admission_year=d.substring(33);
						$(".mask4").hide();
						$("#major").val(major+'/'+admission_year);

						/*验证入学年份和学生证号是否匹配*/
						if($("#stu_id").val()!=""){
							stu_id=$("#stu_id").val();
							var a1=admission_year.substr(-2,2);
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

function beida(){
	var school = ["数学科学学院","物理学院","化学与分子工程学院","地球与空间科学学院","城市与环境学院","生命科学学院","心理学系","环境科学与工程学院","信息科学技术学院","工学院","中国语言文学系","历史学系","考古文博学院","外国语学院","哲学系","艺术学院","国际关系学院","社会学系","法学院","经济学院","光华管理学院","信息管理系","政府管理学院","新闻与传播学院","元培学院"];
	$('#college-list li').remove();
	for(var i=0;i<school.length;i++){
	 $('#college-list').append("<li><i class='icons icons-check'></i>"+school[i]+"</li>");
	}
}
function beiyi(){
	var school = ["基础学院","公共卫生学院","药学院","护理学院","医学人文研究院"];
	$('#college-list li').remove();
	for(var i=0;i<school.length;i++){
	 $('#college-list').append("<li><i class='icons icons-check'></i>"+school[i]+"</li>");
	}
}

function BeiyiMajor(college){
	var major1=["临床医学8年制","临床医学5年制","基础医学8年制","口腔医学8年制","口腔医学5年制","医学实验技术","医学检验技术","口腔医学技术"];
	var major2=["预防医学7年制","预防医学5年制"];
	var major3=["应用药学6年制","应用药学4年制"];
	var major4=["护理学"];
	var major5=["生物医学英语"];

	var major_1=["数学","概率统计","科学与工程计算","信息科学","金融数学"];
	var major_2=["物理学","大气与海洋科学","天体物理"];
	var major_3=["化学","应用化学","材料化学","化学生物学"];
	var major_4=["地质学","地球化学","地球物理","遥感与地理信息系统","空间科学与应用技术"];
	var major_5=["环境科学","生态学","自然地理与资源环境","城市规划（五年制工科）","人文地理与城乡规划"];
	var major6=["生物科学","生物技术"];
	var major7=["基础心理学","应用心理学"];
	var major8=["环境科学","环境工程","环境管理"];
	var major9=["计算机科学与技术","电子信息科学与技术","微电子学","智能科学与技术"];
	var major10=["理论与应用力学","工程结构分析","能源与资源工程","航空航天工程","生物医学工程","材料科学与工程"];
	var major11=["中国文学","汉语语言学","古典文献学","应用文学系"];
	var major12=["历史学（中国史）","世界史","外国语言与外国历史"];
	var major13=["考古学","博物馆学","文物建筑","文物保护"];
	var major14=["英语","法语","德语","俄语","西班牙语","日语","阿拉伯语","朝鲜语（韩国语）","梵语巴利语","印度尼西亚语","乌尔都语","泰语","菲律宾语"];
	var major15=["哲学","宗教学","哲学（科技哲学与逻辑学方向）"];
	var major16=["艺术史论","戏剧影视文学","文化产业管理"];
	var major17=["外交学与外事管理","国际政治","国际政治经济学"];
	var major18=["社会学","社会工作"];
	var major19=["法学"];
	var major20=["经济学","金融学","国际经济与贸易","风险管理与保险学","财政学","发展经济学"];
	var major21=["金融学","金融经济学","会计学","市场营销"];
	var major22=["信息管理与信息系统","图书馆学"];
	var major23=["政治学与行政学","公共政策学","城市管理学","行政管理学"];
	var major24=["新闻学","广播电视新闻学","广告学","编辑出版学","传播学"];
	var major25=["整合科学","政治、经济与哲学","古生物学","外国语言与外国历史","全校教学资源范围内自由选择专业"];
	
	if(college=="基础学院"){
		s2="01";
		$('#cmajor_list li').remove();
		for(var i=0;i<major1.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major1[i]+"</li>");
		}
	}
	if(college=="公共卫生学院"){
		s2="02";
		$('#cmajor_list li').remove();
		for(var i=0;i<major2.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major2[i]+"</li>");
		}
	}
	if(college=="药学院"){
		s2="03"
		$('#cmajor_list li').remove();
		for(var i=0;i<major3.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major3[i]+"</li>");
		}
	}
	if(college=="护理学院"){
		s2="04";
		$('#cmajor_list li').remove();
		for(var i=0;i<major4.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major4[i]+"</li>");
		}
	}
	if(college=="医学人文研究院"){
		s2="05";
		$('#cmajor_list li').remove();
		for(var i=0;i<major5.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major5[i]+"</li>");
		}
	}

	if(college=="数学科学学院"){
		s2="01";
		$('#cmajor_list li').remove();
		for(var i=0;i<major_1.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major_1[i]+"</li>");
		}
	}

	if(college=="物理学院"){
		s2="02";
		$('#cmajor_list li').remove();
		for(var i=0;i<major_2.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major_2[i]+"</li>");
		}
	}

	if(college=="化学与分子工程学院"){
		s2="03";
		$('#cmajor_list li').remove();
		for(var i=0;i<major_3.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major_3[i]+"</li>");
		}
	}

	if(college=="地球与空间科学学院"){
		s2="04";
		$('#cmajor_list li').remove();
		for(var i=0;i<major_4.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major_4[i]+"</li>");
		}
	}
	if(college=="城市与环境学院"){
		s2="05";
		$('#cmajor_list li').remove();
		for(var i=0;i<major_5.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major_5[i]+"</li>");
		}
	}
	if(college=="生命科学学院"){
		s2="06";
		$('#cmajor_list li').remove();
		for(var i=0;i<major6.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major6[i]+"</li>");
		}
	}
	if(college=="心理学系"){
		s2="07";
		$('#cmajor_list li').remove();
		for(var i=0;i<major7.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major7[i]+"</li>");
		}
	}
	if(college=="环境科学与工程学院"){
		s2="08";
		$('#cmajor_list li').remove();
		for(var i=0;i<major8.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major8[i]+"</li>");
		}
	}
	if(college=="信息科学技术学院"){
		s2="09";
		$('#cmajor_list li').remove();
		for(var i=0;i<major9.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major9[i]+"</li>");
		}
	}
	if(college=="工学院"){
		s2="10";
		$('#cmajor_list li').remove();
		for(var i=0;i<major10.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major10[i]+"</li>");
		}
	}
	if(college=="中国语言文学系"){
		s2="11";
		$('#cmajor_list li').remove();
		for(var i=0;i<major11.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major11[i]+"</li>");
		}
	}
	if(college=="历史学系"){
		s2="12";
		$('#cmajor_list li').remove();
		for(var i=0;i<major12.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major12[i]+"</li>");
		}
	}
	if(college=="考古文博学院"){
		s2="13";
		$('#cmajor_list li').remove();
		for(var i=0;i<major13.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major13[i]+"</li>");
		}
	}
	if(college=="外国语学院"){
		s2="14";
		$('#cmajor_list li').remove();
		for(var i=0;i<major14.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major14[i]+"</li>");
		}
	}
	if(college=="哲学系"){
		s2="15";
		$('#cmajor_list li').remove();
		for(var i=0;i<major15.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major15[i]+"</li>");
		}
	}
	if(college=="艺术学院"){
		s2="16";
		$('#cmajor_list li').remove();
		for(var i=0;i<major16.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major16[i]+"</li>");
		}
	}
	if(college=="国际关系学院"){
		s2="17";
		$('#cmajor_list li').remove();
		for(var i=0;i<major17.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major17[i]+"</li>");
		}
	}
	if(college=="社会学系"){
		s2="18";
		$('#cmajor_list li').remove();
		for(var i=0;i<major18.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major18[i]+"</li>");
		}
	}
	if(college=="法学院"){
		s2="19";
		$('#cmajor_list li').remove();
		for(var i=0;i<major19.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major19[i]+"</li>");
		}
	}
	if(college=="经济学院"){
		s2="20";
		$('#cmajor_list li').remove();
		for(var i=0;i<major20.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major20[i]+"</li>");
		}
	}
	if(college=="光华管理学院"){
		s2="21";
		$('#cmajor_list li').remove();
		for(var i=0;i<major21.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major21[i]+"</li>");
		}
	}
	if(college=="信息管理系"){
		s2="22";
		$('#cmajor_list li').remove();
		for(var i=0;i<major22.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major22[i]+"</li>");
		}
	}
	if(college=="政府管理学院"){
		s2="23";
		$('#cmajor_list li').remove();
		for(var i=0;i<major23.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major23[i]+"</li>");
		}
	}
	if(college=="新闻与传播学院"){
		s2="24";
		$('#cmajor_list li').remove();
		for(var i=0;i<major24.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major24[i]+"</li>");
		}
	}
	if(college=="元培学院"){
		s2="25";
		$('#cmajor_list li').remove();
		for(var i=0;i<major25.length;i++){
	 		$('#cmajor_list').append("<li><i class='icons icons-check'></i>"+major25[i]+"</li>");
		}
	}


}

function s3(major){
	if(major=="临床医学8年制"){s3="01";}
	if(major=="临床医学5年制"){s3="02";}
	if(major=="基础医学8年制"){s3="03";}
	if(major=="口腔医学8年制"){s3="04";}
	if(major=="口腔医学5年制"){s3="05";}
	if(major=="医学实验技术"){s3="06";}
	if(major=="医学检验技术"){s3="07";}
	if(major=="口腔医学技术"){s3="08";}
	if(major=="预防医学7年制"){s3="01";}
	if(major=="预防医学5年制"){s3="02";}
	if(major=="应用药学6年制"){s3="01";}
	if(major=="应用药学4年制"){s3="02";}
	if(major=="护理学"){s3="01";}
	if(major=="生物医学英语"){s3="01";}
	if(major=="数学"){s3="01";}
	if(major=="概率统计"){s3="02";}
	if(major=="科学与工程计算"){s3="03";}
	if(major=="信息科学"){s3="04";}
	if(major=="金融数学"){s3="05";}
	if(major=="物理学"){s3="01";}
	if(major=="大气与海洋科学"){s3="02";}
	if(major=="天体物理"){s3="03";}
	if(major=="化学"){s3="01";}
	if(major=="应用化学"){s3="02";}
	if(major=="材料化学"){s3="03";}
	if(major=="化学生物学"){s3="04";}
	if(major=="地质学"){s3="01";}
	if(major=="地球化学"){s3="02";}
	if(major=="地球物理"){s3="03";}
	if(major=="遥感与地理信息系统"){s3="04";}
	if(major=="空间科学与应用技术"){s3="05";}
	if(major=="环境科学"){s3="01";}
	if(major=="生态学"){s3="02";}
	if(major=="自然地理与资源环境"){s3="03";}
	if(major=="城市规划（五年制工科）"){s3="04";}
	if(major=="人文地理与城乡规划"){s3="05";}
	if(major=="生物科学"){s3="01";}
	if(major=="生物技术"){s3="02";}
	if(major=="基础心理学"){s3="01";}
	if(major=="应用心理学"){s3="02";}
	if(major=="环境科学"){s3="01";}
	if(major=="环境工程"){s3="02";}
	if(major=="环境管理"){s3="03";}
	if(major=="计算机科学与技术"){s3="01";}
	if(major=="电子信息科学与技术"){s3="02";}
	if(major=="微电子学"){s3="03";}
	if(major=="智能科学与技术"){s3="04";}
	if(major=="理论与应用力学"){s3="01";}
	if(major=="工程结构分析"){s3="02";}
	if(major=="能源与资源工程"){s3="03";}
	if(major=="航空航天工程"){s3="04";}
	if(major=="生物医学工程"){s3="05";}
	if(major=="材料科学与工程"){s3="06";}
	if(major=="中国文学"){s3="01";}
	if(major=="汉语语言学"){s3="02";}
	if(major=="古典文献学"){s3="03";}
	if(major=="应用文学系"){s3="04";}
	if(major=="历史学（中国史）"){s3="01";}
	if(major=="世界史"){s3="02";}
	if(major=="外国语言与外国历史"){s3="03";}
	if(major=="考古学"){s3="01";}
	if(major=="博物馆学"){s3="02";}
	if(major=="文物建筑"){s3="03";}
	if(major=="文物保护"){s3="04";}
	if(major=="英语"){s3="01";}
	if(major=="法语"){s3="02";}
	if(major=="德语"){s3="03";}
	if(major=="俄语"){s3="04";}
	if(major=="西班牙语"){s3="05";}
	if(major=="日语"){s3="06";}
	if(major=="阿拉伯语"){s3="07";}
	if(major=="朝鲜语（韩国语）"){s3="08";}
	if(major=="梵语巴利语"){s3="09";}
	if(major=="印度尼西亚语"){s3="10";}
	if(major=="乌尔都语"){s3="11";}
	if(major=="泰语"){s3="12";}
	if(major=="菲律宾语"){s3="13";}
	if(major=="哲学"){s3="01";}
	if(major=="宗教学"){s3="02";}
	if(major=="哲学（科技哲学与逻辑学方向）"){s3="03";}
	if(major=="艺术史论"){s3="01";}
	if(major=="戏剧影视文学"){s3="02";}
	if(major=="文化产业管理"){s3="03";}
	if(major=="外交学与外事管理"){s3="01";}
	if(major=="国际政治"){s3="02";}
	if(major=="国际政治经济学"){s3="03";}
	if(major=="社会学"){s3="01";}
	if(major=="社会工作"){s3="02";}
	if(major=="法学"){s3="01";}
	if(major=="经济学"){s3="01";}
	if(major=="金融学"){s3="02";}
	if(major=="国际经济与贸易"){s3="03";}
	if(major=="风险管理与保险学"){s3="04";}
	if(major=="财政学"){s3="05";}
	if(major=="发展经济学"){s3="06";}
	if(major=="金融学"){s3="01";}
	if(major=="金融经济学"){s3="02";}
	if(major=="会计学"){s3="03";}
	if(major=="市场营销"){s3="04";}
	if(major=="信息管理与信息系统"){s3="01";}
	if(major=="图书馆学"){s3="02";}
	if(major=="政治学与行政学"){s3="01";}
	if(major=="公共政策学"){s3="02";}
	if(major=="城市管理学"){s3="03";}
	if(major=="行政管理学"){s3="04";}
	if(major=="新闻学"){s3="01";}
	if(major=="广播电视新闻学"){s3="02";}
	if(major=="广告学"){s3="03";}
	if(major=="编辑出版学"){s3="04";}
	if(major=="传播学"){s3="05";}
	if(major=="整合科学"){s3="01";}
	if(major=="政治、经济与哲学"){s3="02";}
	if(major=="古生物学"){s3="03";}
	if(major=="外国语言与外国历史"){s3="04";}
	if(major=="全校教学资源范围内自由选择专业"){s3="05";}

}


})