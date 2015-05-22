$(function(){
/*选择银行*/
	$("#bank-name").click(function(){
		$(".mask7").show();
		$(".mask7").height($(window).height());
		var wheight=$(window).height();
		var cschool=$("#c_bank").height();

		$("#c_bank").css("top",Math.round((wheight-cschool)/2-10));
		$("#cbank-list li").click(function(){
			$(this).addClass("active").siblings().removeClass();
			a=$(this).html();
			$(".mask7").hide();	
			$("#bank-name").val(a.substring(33));
		})
		$("#close8").click(function(){
			$(".mask7").hide();
		})
	})/*$("#bank-name")结束*/

/*银行卡号输入验证*/
	$("#bc-num").blur(function(){
		$("#i1").hide();
		bc_num= this.value;
		RegCellbcnum = /^\d{19}$/g;
		falg=bc_num.search(RegCellbcnum);
		/*bc_len=bc_num.length;*/
		if(falg==-1){
			$("#error").html("请输入正确的银行卡号");
			$("#validate").show();
			$("#bc-num").click(function(){
				$("#validate").hide();
			})
			this.focus();
		}
	})

/*验证提示框位置适配*/
	wheight=$(window).height();
	$("#validate").css("top",-wheight/2);

/*确认银行卡号输入验证*/
	$("#cbc-num").blur(function(){
		$("#i2").hide();
		cbc_num= this.value;
		bc_num=$("#bc-num").val();
		if(cbc_num != bc_num){
			$("#error").html("银行卡号输入不一致");
			$("#validate").show();
			$("#cbc-num").click(function(){
				$("#validate").hide();
			})
			this.focus();
		}
	})

/*填写姓名验证*/
$("#name").blur(function(){
		$("#i3").hide();
		sname= this.value;
		RegCellName = /^[\u4e00-\u9fa5\.]+$/;
		falg=sname.search(RegCellName);
		
		if(falg==-1){
			$("#error").html("请输入真实姓名");
			$("#validate").show();
			$("#name").click(function(){
				$("#validate").hide();
			})
			this.focus();
		}
	})


/*身份证号输入验证*/
	$("#id-num").blur(function(){
		$("#i4").hide();
		id_num= this.value;
		RegCellidnum = /^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/;
		falg=id_num.search(RegCellidnum);
		/*bc_len=bc_num.length;*/
		if(falg==-1){
			$("#error").html("请输入正确的身份证号");
			$("#validate").show();
			$("#id-num").click(function(){
				$("#validate").hide();
			})
			this.focus();
		}
	})

/*手机号输入验证*/
	$("#phone-num").blur(function(){
		$("#i5").hide();
		phone_num= this.value;
		RegCellphonenum = /^1\d{10}$/;
		falg=phone_num.search(RegCellphonenum);
		/*bc_len=bc_num.length;*/
		if(falg==-1){
			$("#error").html("请输入正确的手机号");
			$("#validate").show();
			$("#phone-num").click(function(){
				$("#validate").hide();
			})
			this.focus();
		}
	})


/*验证个人信息是否完整*/
	function cmd(){

		var ipt=document.getElementById("form2").getElementsByTagName("input");
		var ipt_flag=1;
		for(var i=0; i<ipt.length-1; i++){
			if(ipt[i].value.length == 0){		
				ipt_flag=0;
			}
		}
		if(ipt_flag==1){
			$("#next2").removeAttr("disabled");
		}
	}

	$("#form2 input").click(function(){
		cmd();
	})

/*输入详细地址时触发（填写完信息后让下一步变蓝）*/
	$('#phone-num').bind('input propertychange', function() {cmd();}); 

/*个人信息被占用提示框*/
	$(".mask8").height($(window).height());
	var wheight=$(window).height();
	var cschool=$("#error3").height();

	$("#error3").css("top",Math.round((wheight-cschool)/2-10));
	$("#e3-close").click(function(){
		$(".mask8").hide();
	})



})/*$(function()结束*/