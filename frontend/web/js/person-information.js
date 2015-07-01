$(function(){

	var name = $("#name");
		name.on("keyup",function(){
			var name_val = this.value.replace(/[^\u4E00-\u9FA5\·\u4E00-\u9FA5$]/g,'');
			this.value = name_val;
		})

/*验证提示框位置适配*/
	wheight=$(window).height();
	$("#n_validate").css("top",-wheight/2);
	/*姓名输入验证*/
	function validateName(){
		/*$("#n_validate").fadeTo(500,1);*/
		$("#n_validate").show();
		$("#name").click(function(){
			$("#n_validate").hide();
		})
	}

	/*验证个人信息是否完整*/
	function cmd(){

		var ipt=document.getElementById("form1").getElementsByTagName("input");
		var ipt_flag=1;
		for(var i=0; i<ipt.length; i++){
			if(ipt[i].value.length == 0){		
				ipt_flag=0;
			}
		}
		if(ipt_flag==1){
			$("#next").removeAttr("disabled");

		}else{
			$("#next").attr("disabled","disabled");
		}
	}

	$("#form1 input").click(function(){
		cmd();
	})
	/*输入每个输入框时判断表单是否完整*/
	
	$('#name').bind('input propertychange', function() {cmd();});
	$('#stu_id').bind('input propertychange', function() {cmd();});
	$('#school-name').bind('input propertychange', function() {cmd();});
	$('#major').bind('input propertychange', function() {cmd();});
	$('#address').bind('input propertychange', function() {cmd();}); 
	
	$("#next").click(function(){

		var school=$("#school-name").html();
		var major=$("#major").html();
		  
			/*ss=s2(school,major);*/
			var major_len=major.length-5;
			var college=major.substr(0,major_len);
			ss(school,college);
			/*alert(s1+s2);*/
			$("#school_id").val(s1+s2);

			sname= $("#name").val();
			/*RegCellName = /^[\u4e00-\u9fa5\·]*$/;
			falg=sname.search(RegCellName);*/
			/*alert(sname.length);*/
			if(sname.length<2){
				falg=-1;
			}else{
				falg=0;
			}
			
			if(falg==-1){
				$("#error").html("请输入真实姓名");
				$("#n_validate").show().delay(3000).fadeOut();
				/*$("#name").click(function(){
					$("#n_validate").hide();
				})*/
				$("#name").focus();
			}
		
		if(falg!=-1){
			stu_id= $("#stu_id").val();
			/*RegCellStuid = /^([0-9]*)?$/;*/
			RegCellStuid =/^(\d{8}|\d{10})$/;
			falg1=stu_id.search(RegCellStuid);
			stu_len=stu_id.length;
			if(falg1==-1 || stu_len!=8 && stu_len!=10){
				$("#error").html("请输入正确的学生证号");
				$("#n_validate").show().delay(3000).fadeOut();
				/*$("#stu_id").click(function(){
					$("#n_validate").hide();
				})*/
				$("#stu_id").focus();
			}
		}

		if(falg!=-1 && falg1!=-1){
			address=$("#address").val();
			RegCellAddress =/[\u4e00-\u9fa5A-Za-z0-9]+/g;
			falg2=address.search(RegCellAddress);
			if(falg2==-1){
				$("#error").html("地址包含非法字符");
				$("#n_validate").show().delay(3000).fadeOut();
				/*$("#stu_id").click(function(){
					$("#n_validate").hide();
				})*/
				$("#address").focus();
			}

		}

		if(falg!=-1 && falg1!=-1 && falg2!=-1 && stu_len==8 || falg!=-1 && falg1!=-1 && falg2!=-1  && stu_len==10){
			$("#next1").click();
		}
		
	})

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

/*个人信息被占用提示框*/
function error3(){
	$(".mask8").height($(window).height());
	var wheight=$(window).height();
	var cschool=$("#error3").height();
	$("#error3").css("top",Math.round((wheight-cschool)/6));
	$("#e3-close").click(function(){
		$(".mask8").hide();
	})
}

})    /*$(function)结束*/

function ss(school,college){
	 if(school=="北京大学（医学部）"){
			s1="101";
		}
	if(school=="北京大学"){
				s1="102";
		}
		
	if(college=="临床医学8年制" || college=="城市与环境学院"){
		s2="01";
	}
	if(college=="基础医学8年制" || college=="地球与空间科学学院"){s2="02";}
	if(college=="口腔医学8年制" || college=="法学院"){s2="03";}
	if(college=="预防医学7年制" || college=="工学院"){s2="04";}
	if(college=="应用药学6年制" || college=="光华管理学院"){s2="05";}
	if(college=="临床医学5年制" || college=="国际关系学院"){s2="06";}
	if(college=="口腔医学5年制" || college=="化学与分子工程学院"){s2="07";}
	if(college=="生物医学英语" || college=="环境科学与工程学院"){s2="08";}
	if(college=="预防医学5年制" || college=="经济学院"){s2="09";}
	if(college=="应用药学4年制" || college=="考古文博学院"){s2="10";}
	if(college=="护理学" || college=="历史学系"){s2="11";}
	if(college=="医学实验技术" || college=="社会学系"){s2="12";}
	if(college=="医学检验技术" || college=="生命科学学院"){s2="13";}
	if(college=="口腔医学技术" || college=="数学科学学院"){s2="14";}

	if(college=="外国语学院"){s2="15";}
	if(college=="物理学院"){s2="16";}
	if(college=="心理学系"){s2="17";}
	if(college=="新闻与传播学院"){s2="18";}
	if(college=="信息管理系"){s2="19";}
	if(college=="信息科学技术学院"){s2="20";}
	if(college=="艺术学院"){s2="21";}
	if(college=="元培学院"){s2="22";}
	if(college=="哲学系"){s2="23";}
	if(college=="政府管理学院"){s2="24";}
	if(college=="中国语言文学系"){s2="25";}

	
}
