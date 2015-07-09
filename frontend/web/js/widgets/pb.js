/**
 * 
 * check of bank and card 
 * 
 * 
 * 
 * 20150617
 */

function Log(msg){
	msg = msg || 'empty';
	if(envirment=="production"){

	} else {
		console.log(msg);	
	}
	
}

(function($, undefined){
	//生产类
	var Pub = function(el, op){
		this.$el = $(el);
		
		this.boxFlag = 0;//标志卡号合法之后，下面层出现与否
		this.iFlag = 1;//标志所有数据合法时，提交按钮提交次数
		this.nameInput = this.$el.find('[node-type="LoanNameInput"]');
		this.cardInput = this.$el.find('[node-type="LoanCardInput"]');
		this.submitBtn = this.$el.find('[node-type="LoanSubmitBtn"]');
		this.bankCardIcon = this.$el.find('[node-type="LoanBankCardIcon"]');
		this.idCardInput = this.$el.find('[node-type="LoanIdCardInput"]');
		this.mobileIcon = this.$el.find('[node-type="LoanMobileIcon"]');
		this.mobileInput = this.$el.find('[node-type="LoanMobileInput"]');
		this.agreement = $("#agreement-btn");
		this.agreeClose = $("#close10");
		this.agree= $("#agreement");
		this.imbox = $("#imbox");
		this.bankName = $("#bank_name");
		this.mask = $("#masker");
		this.iconOption = $(".icon-option");
		this.loading = $("#loading_masker");
		this.loadingImg = $("#loadingImg");
		this._addEvents();
	}
	
	Pub.prototype = {
		//所有事件绑定
		_addEvents : function(){
			var sthis=this;
			/*协议弹框高度初始化*/
			var wheight = $(window).height();
					wwidth = $(window).width();
					agreeList = $("#agree_list");

				/*sthis.agree.css("left",-wwidth);*/
				agreeList.height(wheight/6*4);
				sthis.agree.css("top",wheight/8);
						
			/*判断信息完整*/
			this.$el.find("input").on("input", function(){
				var _this = this;
				/*Log('AAA');*/
				setTimeout(function(){
					sthis._fnComplete();
					var Id = $(_this).attr("id");
					if(Id=="ID_card"){
						var idCard_val = $(_this).val();
						_this.value = sthis._fnIdentity(idCard_val);
					}
				},500)
			})

			/*卡号输入判断*/
			this.cardInput.on("keyup", function(){
				var card_id = this.value,
					bankCard = this;
				this.value=sthis._fnCard(card_id,bankCard);
			})
			/*身份证号输入判断*/
			this.idCardInput.on("keyup", function(){
				var idCard_val = this.value;
				this.value = sthis._fnIdentity(idCard_val);
				if(this.value==0){
					$(this).siblings().hide();
				}else{
					$(this).siblings().show();
				}
			})
			/*icon单机操作*/
			this.$el.find(".icon-option").on("click", function(){
				var icon_this=this;
				sthis._fnIcon(icon_this);	
			})

			/*失去焦点隐藏icon*/
			this.$el.find("input").on("focus", function(){
				sthis.iconOption.hide();
				if(this.id=="ID_card"){
					if(this.value.length > 1){
						$(this).siblings().show();
					}
				}else{
					$(this).siblings().show();
				} 
			})
			/*手机号输入判断*/
			this.mobileInput.on("keyup",function(){
				var mobile_val = this.value;
				this.value = sthis._fnModile(mobile_val);
			})

			/*提交按钮*/
			this.submitBtn.on("click",function(){
				
				var zCard = $("#bank_card").val();
				var zIdCard = $("#ID_card").val();
				var zMobile = $("#mobile").val();
				var zName = $("#name").val();
				sthis._fnSubmit(zCard,zIdCard,zMobile,zName);
				
			})
			/*协议*/
			this.agreement.on("click",function(){
						
				sthis._fnGetAgree();
				sthis.mask.show();
				sthis.agree.show();
				sthis.agree.css("left",0);
			})

			this.agreeClose.on("click",function(){
				sthis.mask.hide();
				sthis.agree.hide();
			})


		},
		//卡号处理
		_fnCard : function(card_id,bankCard){
			card_id = card_id.replace(/\D/g,'').replace(/....(?!$)/g,'$& ');
			var b_len = card_id.length,
				bRIcon = $("#bRIcon"),
				bank_type=TOOLS.isBank(card_id.replace(/\s+/g,""));
			if(b_len==0){
				bRIcon.addClass("active").show().siblings().hide();
				this.imbox.hide();
				this.bankName.hide();
			}else if(b_len==1){
				bRIcon.removeClass("active").hide().siblings().show().removeClass("active");	
			}else if(b_len==18 && bank_type.len==15){
				this.boxFlag=1;
				this.imbox.show();
				this.agreement.show();
				setTimeout(function(){
					TOOLS.animate(180,500)
				},200);	
			}else if(b_len==19 && bank_type.len==16){			
				this.boxFlag=1;
				this.imbox.show();
				this.agreement.show();
				setTimeout(function(){
					TOOLS.animate(180,500)
				},200);	
			}else if(b_len==21 && bank_type.len==17){
				this.boxFlag=1;
				this.imbox.show();
				this.agreement.show();
				setTimeout(function(){
					TOOLS.animate(180,500)
				},200);	
			}else if(b_len==22 && bank_type.len==18){
				this.boxFlag=1;
				this.imbox.show();
				this.agreement.show();
				setTimeout(function(){
					TOOLS.animate(180,500)
				},200);	
			}else if(b_len==23 && bank_type.len==19){
				this.boxFlag=1;
				this.imbox.show();
				this.agreement.show();
				setTimeout(function(){
					TOOLS.animate(180,500)
				},200);		
			}else if(b_len<12){	
				this.imbox.hide();
				this.agreement.hide();
				this.boxFlag=0;
				this.bankName.hide();
			}else if(b_len>=12){
				
				if(bank_type.bank){
					this.bankName.find("span").removeClass();
					this.bankName.find("span").addClass("bankName "+bank_type.bank);
					this.bankName.show();
					if(bank_type.len>16){
						$(bankCard).attr("maxlength",bank_type.len+4);
					}else{
						$(bankCard).attr("maxlength",bank_type.len+3);
					}
					
				}else{
					$(bankCard).attr("maxlength","23");
				}
			}

			return card_id;
		},
		//身份证处理
		_fnIdentity : function(idCard_val){
			idCard_val=idCard_val.replace(/[^\d|xX]/g,"");
			return idCard_val;
		},
		//手机号验证
		_fnModile : function(mobile_val){
			mobile_val = mobile_val.replace(/\D/g,'');
			var m_len = mobile_val.length;
				mRIcon = $("#mRIcon");

			if(m_len==0){
				mRIcon.addClass("active").show().siblings().hide();
			}else if(m_len==1){
				mRIcon.removeClass("active").hide().siblings().show().removeClass("active");
			}

			return mobile_val;
		}, 
		//表单处理
		_fnComplete : function(){
			var ipt=this.$el.find("input"),
				next=$("#next2"),
				ipt_flag=1,
				ipt_len=4;

			if(this.boxFlag==0){
				ipt_len=2;
			}
			for(var i=0; i<ipt_len; i++){
				if(ipt[i].value.length == 0){       
					ipt_flag=0;
				}
			}
			if(ipt_flag==1){
				next.removeAttr("disabled");
			}else{
				next.attr("disabled","disabled");
			}	 
		},
		//icon处理
		_fnIcon : function(icon_this){
			var intype = $(icon_this).attr("node-type");
			var inIs = $(icon_this).find("i");
			var inIsD = $(inIs[0]).css("display");
			var next=$("#next2");
			if(inIs.hasClass("icons-infoNew active")){
				if(inIs.is(".icons-infoNew") && intype=="bank_card"){
					MessageBox.alert({type:"message",txt:CS.ERRORMSG["EFFECTIVEBANK"]});
				}else{
					MessageBox.alert({type:"message",txt:CS.ERRORMSG["AVAILABLEPHONENUMBER"]});
				}
			}else{
				if(inIs.is(".icons-infoNew")){	
					$('#'+intype).val("");
					$(inIs[0]).addClass("active").show();
					$(inIs[1]).hide();
					if(intype=="bank_card"){
						this.agreement.hide();
						this.imbox.hide();
						this.bankName.hide();
						this.idCardInput.val("");
						this.mobileInput.val("");
					}
					next.attr("disabled","disabled");
				}else{
					$('#'+intype).val("");
					$(inIs[0]).parent().hide();
					next.attr("disabled","disabled");
				}	
			}
		},

		/*获取协议*/
		_fnGetAgree : function(){
			var now = new Date();
				year = now.getFullYear();
				month = now.getMonth()+1;
				day = now.getDate();
				name = $("#name").val();
				id_card = $("#ID_card").val();
				bank_card = $("#bank_card").val();
			$("#year").html(year);
			$("#year1").html(year);
			$("#month").html(month);
			$("#month1").html(month);
			$("#day").html(day);
			$("#day1").html(day);
			$("#c_id").html(id_card);
			$("#c_bid").html(bank_card);
			$("#c_name").html(name);
		},

		//提交按钮处理
		_fnSubmit : function(zCard,zIdCard,zMobile,zName){
			var zCard_len = zCard.length,
				age = TOOLS.isIdentity(zIdCard),
				phone = TOOLS.isMobile(zMobile),
				bcflag = TOOLS.isCard(zCard.replace(/\s+/g,"")),
				bcflag2 = TOOLS.isBank(zCard.replace(/\s+/g,"")),
				zzCard = zCard.replace(/\s+/g,""),
				smBtn = $("#next2"),
				cbank_name,
				bank_index = -1,
				mask = this.mask,
				loading = this.loading,
				loadingImg = this.loadingImg,
				bankListE = ["IBCB","ABC","CCB","CMB","BOC","PSBC","COMM","CITIC","CMBC","CEB","CIB","SPDB","GDB","HXBANK","SPABANK","BJBANK","BJRCB","SHBANK","JSBANK"],
				bankListC = ["中国工商银行","中国农业银行","中国建设银行","招商银行","中国银行","中国邮政储蓄银行","交通银行","中信银行","中国民生银行","中国光大银行","兴业银行","浦发银行","广发银行","华夏银行","平安银行","北京银行","北京农商银行","上海银行","江苏银行"];
				
				this.iconOption.hide();
				
				if(bcflag2){
					for(var i=0;i<bankListE.length;i++){
						if(bcflag2.bank == bankListE[i]){bank_index = i;}
					}
					cbank_name = bankListC[bank_index];
				}
			if(this.boxFlag){
				
				if(bcflag){
					if(age){
						if(age>30 || age<16){
							MessageBox.alert({type:"common",txt:CS.ERRORMSG["AGENOTRANGEERROR"]});
						}else{
							if(phone){
								/*提交*/	
								if(smBtn.hasClass("disabled")) return false;
								smBtn.addClass('disabled');
								mask.addClass("masker-60").show();
								setTimeout(function(){
									loading.css({height:"100%"}).show();	
								},200);		 					
								TOOLS.ajax({
									url:"./index.php?r=loan/verify",
									data:{name:zName,bank_card:zzCard,id_card:zIdCard,mobile:zMobile,bank_name:cbank_name},
									dataType:"json",
									type:"post",
									fnSuccess:function(data){
										if(data.stat == "1"){
											window.location.href= "./index.php?r=loan/sms&mobile="+data.mobile;
										}else if(data.stat == "2"){
											if(data.verify_times == "2"){
												loadingImg.hide();
												MessageBox.alert({type:"message",txt:CS.ERRORMSG["TWOCHANCE"],cls:true});
												smBtn.removeClass("disabled");
											}else if(data.verify_times == "1"){
												loadingImg.hide();
												MessageBox.alert({type:"message",txt:CS.ERRORMSG["ONECHANCE"],cls:true});
												smBtn.removeClass("disabled");
											}else if(data.verify_times <= "0"){
												window.location.href= "./index.php?r=loan/failed";
											}
										}else if(data.stat == "5"){
											loadingImg.hide();
											MessageBox.alert({type:"message",txt:"当前学生信息已被占用，请核实重新填写。"});
											smBtn.removeClass("disabled");
										}else{
											loadingImg.hide();
											MessageBox.alert({type:"message",txt:"系统错误，请稍后重试！"});
											smBtn.removeClass("disabled");
										}
										// mask.removeClass("masker-60").hide();
										loading.hide();
									},
									fnError:function(){
										loadingImg.hide();
										loading.hide();
										MessageBox.alert({type:"message",txt:"系统繁忙，请稍后重试！"});
										smBtn.removeClass("disabled");
									}
								});

							}else{
								MessageBox.alert({type:"common",txt:CS.ERRORMSG["MOBILEERROR"]});
							}
						}
					}else{
						MessageBox.alert({type:"common",txt:CS.ERRORMSG["IDENTITYERROR"]});
					}
				}else{
					MessageBox.alert({type:"common",txt:CS.ERRORMSG["BANKCARDERROR"]});
				}		
				
			}else{
				
				if(bcflag2){
					if(bcflag){
					}else{
						MessageBox.alert({type:"common",txt:CS.ERRORMSG["BANKCARDERROR"]});
					}
				}else{
					MessageBox.alert({type:"common",txt:CS.ERRORMSG["NOBANKERROR"]});
				}
			}
		
		}
	}
	
	
	$.fn.PUB = function(options){
		return this.each(function(){
			var $this = $(this) , 
				data = $this.data('PUB');
			
	          if (!data) {
	        	  $this.data('PUB', (data = new Pub(this, options)))
	          }
	          
	          if (typeof options == 'string') data[options](setData);
		});
	}
})(window.jQuery||window.Zepto)
