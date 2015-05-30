$(function(){

	/*验证提示框位置适配*/
	wheight=$(window).height();
	$("#validate").css("top",-wheight/2);
	
	wwidth=$(window).width();
	$("#c_bank").css("left",-wwidth);
	$("#agreement").css("left",-wwidth);

	var wheight=$(window).height();
	$("#cbank_list").css("height",wheight/6*4);
/*协议操作*/
	$("#agree_list").height(wheight/6*4);
	$("#agreement").css("top",wheight/8);

	$("#agreement-btn").click(function(){
		getAgree();
		$(".mask9").show();
		$("#agreement").css("left",0);
		$("#close10").click(function(){
			$(".mask9").hide();				
		})
	})

	$(".agree").click(function(){
		$(".mask9").hide();		
	})



/*选择银行*/
	$("#bank-name").click(function(){
		$(".mask7").show();
		$(".mask7").height($(window).height());
		$("#c_bank").css("top",wheight/8);
		
		scbank=$("#c_bank").height();
		$("#c_bank").css("top",Math.round());

		$("#c_bank").css("left",0);

		$("#cbank-list li").click(function(){
			$(this).addClass("active").siblings().removeClass();
			a=$(this).html();
			$(".mask7").hide();	
			$("#bank_name").val(a.substring(33));
			$("#bank-name").html(a.substring(33));
			$("#bank-name").removeClass("d-color");
		})
		$("#close8").click(function(){
			$(".mask7").hide();
		})
	})/*$("#bank-name")结束*/



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
		}else{
			$("#next2").attr("disabled","disabled");
		}
	}

	$("#form2 input").click(function(){
		cmd();
	})

/*输入详细地址时触发（填写完信息后让下一步变蓝）*/
	$('#bank-name').bind('input propertychange', function() {cmd();});
	$('#bc-num').bind('input propertychange', function() {cmd();});
	$('#cbc-num').bind('input propertychange', function() {cmd();});
	$('#name').bind('input propertychange', function() {cmd();});
	$('#id-num').bind('input propertychange', function() {cmd();});
	$('#phone-num').bind('input propertychange', function() {cmd();}); 


	$("#next2").click(function(){
		
			/*$("#i1").hide();*/
			bc_num= $("#bc-num").val();
			RegCellbcnum = /^(\d{16}|\d{19})$/;
			falg=bc_num.search(RegCellbcnum);
			bc_len=bc_num.length;
			
			if(falg==-1 || bc_len==16 && bc_len==19){
				falg=-1;
				$("#error").html("请输入正确的银行卡号");
				$("#validate").show().delay(3000).fadeOut();
				/*$("#bc-num").click(function(){
					$("#validate").hide();
				})*/
				$("#bc-num").focus();
			}

			if(falg!=-1){
				/*$("#i2").hide();*/
				cbc_num= $("#cbc-num").val();
				bc_num=$("#bc-num").val();
				falg1=1;
				if(cbc_num != bc_num){
					falg1=-1;
					$("#error").html("银行卡号输入不一致");
					$("#validate").show().delay(3000).fadeOut();
					/*$("#cbc-num").click(function(){
						$("#validate").hide();
					})*/
					$("#cbc-num").focus();
				}

			}
			if(falg!=-1 && falg1!=-1){
				falg2=0;
				id_num= $("#id-num").val();
				if(!isCnNewID(id_num)){
					falg2=-1;
					$("#error").html("请输入正确的身份证号");
					$("#validate").show().delay(3000).fadeOut();
					$("#id-num").focus();
				}
				/*$("#i4").hide();*/
				
				/*RegCellidnum = /^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/;
				falg2=id_num.search(RegCellidnum);
				if(falg2==-1){
					$("#error").html("请输入正确的身份证号");
					$("#validate").show().delay(3000).fadeOut();
					$("#id-num").focus();
				}*/
			}

			if(falg!=-1 && falg1!=-1 && falg2!=-1){
				/*$("#i5").hide();*/
				phone_num= $("#phone-num").val();
				/*RegCellphonenum = /^1\d{10}$/;*/
				RegCellphonenum = /^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$/;
				falg3=phone_num.search(RegCellphonenum);

				if(falg3==-1){
					$("#error").html("请输入正确的手机号");
					$("#validate").show().delay(3000).fadeOut();
					/*$("#phone-num").click(function(){
						$("#validate").hide();
					})*/
					$("#phone-num").focus();
				}
			}

			if(falg!=-1 && falg1!=-1 && falg2!=-1 && falg3!=-1){
				$("#next3").click();
			}
			/*$("#next3").click();*/
		
	})


/*个人信息被占用提示框*/
	$(".mask8").height($(window).height());
	var wheight=$(window).height();
	var cschool=$("#error3").height();

	$("#error3").css("top",Math.round((wheight-cschool)/2-10));
	$("#e3-close").click(function(){
		$(".mask8").hide();
	})



})/*$(function()结束*/
function getAgree(){
	var now = new Date();
	var year = now.getFullYear();
	var month = now.getMonth()+1;
	var day = now.getDate();
	$("#year").html(year);
	$("#year1").html(year);
	$("#month").html(month);
	$("#month1").html(month);
	$("#day").html(day);
	$("#day1").html(day);
	$("#c_id").html($("#id-num").val());
	$("#c_id1").html($("#id-num").val());
	$("#c_bid").html($("#bc-num").val());
}

function isCnNewID(cid){
    var arrExp = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];//加权因子
    var arrValid = [1, 0, "X", 9, 8, 7, 6, 5, 4, 3, 2];//校验码
    var reg = /^\d{17}\d|x$/i;
    if(reg.test(cid)){
        var sum = 0, idx;
        for(var i = 0; i < cid.length - 1; i++){
            // 对前17位数字与权值乘积求和
            sum += parseInt(cid.substr(i, 1), 10) * arrExp[i];
        }
        // 计算模（固定算法）
        idx = sum % 11;
        // 检验第18为是否与校验码相等
        return arrValid[idx] == cid.substr(17, 1).toUpperCase();
    }else{
        return false;
    }
}