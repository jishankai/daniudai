$(function(){
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


	$("#name").blur(function(){
		sname= this.value;
		RegCellName = /^[\u4e00-\u9fa5\.]+$/;
		falg=sname.search(RegCellName);
		
		if(falg==-1){
			$("#error").html("请输入真实姓名");
			$("#n_validate").show();
			$("#name").click(function(){
				$("#n_validate").hide();
			})
			this.focus();
		}
	})

	/*学生证号输入验证*/
	$("#stu_id").blur(function(){
		stu_id= this.value;
		RegCellStuid = /^([0-9]*)?$/;
		falg=stu_id.search(RegCellStuid);
		stu_len=stu_id.length;
		if(falg==-1 || stu_len!="8" && stu_len!="10"){
			$("#error").html("请输入正确的学生证号");
			$("#n_validate").show();
			$("#stu_id").click(function(){
				$("#n_validate").hide();
			})
			this.focus();
		}
		if($("#major").val()!=""){
			var v1=$("#major").val().substr(-2,2);		
			var v2=$("#stu_id").val().substr(0,2);
			if(v1!=v2){
				error2();
				$("#stu_id").focus();
			}
		}
	})

	/*验证个人信息是否完整*/
	function cmd(){

		var ipt=document.getElementById("form1").getElementsByTagName("input");
		var ipt_flag=1;
		for(var i=0; i<ipt.length-1; i++){
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
	$('#majot').bind('input propertychange', function() {cmd();});
	$('#address').bind('input propertychange', function() {cmd();}); 

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

	$("#error3").css("top",Math.round((wheight-cschool)/2-10));
	$("#e3-close").click(function(){
		$(".mask8").hide();
	})
}

})    /*$(function)结束*/


