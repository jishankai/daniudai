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
		this._addEvents();

	}
	
	Pub.prototype = {
		//初始化
		_init : function(){
		
		},
		//所有事件绑定
		_addEvents : function(){
			var sthis=this;
						
			/*判断信息完整*/
			this.$el.find("input").on("input", function(){
				/*Log('AAA');*/
				setTimeout(function(){sthis._fnComplete();},500)
				 
			})

			/*卡号输入判断*/
			this.cardInput.on("keyup", function(){
				var card_id=this.value;
				this.value=sthis._fnCard(card_id);
			})
			/*身份证号输入判断*/
			this.idCardInput.on("keyup", function(){
				var idCard_val = this.value;
				this.value = sthis._fnIdentity(idCard_val);
			})
			/*icon单机操作*/
			this.$el.find(".icon-option").on("click", function(){
				var icon_this=this;
				sthis._fnIcon(icon_this);	
			})

			/*失去焦点隐藏icon*/
			this.$el.find("input").on("focus", function(){
				sthis.iconOption.hide();
				$(this).siblings().show(); 
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
				var wheight = $(window).height();
					wwidth = $(window).width();
					agreeList = $("#agree_list");

				/*sthis.agree.css("left",-wwidth);*/
				agreeList.height(wheight/6*4);
				sthis.agree.css("top",wheight/8);		
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
		//名字处理
		_fnName : function(){
			
		},
		//卡号处理
		_fnCard : function(card_id){
			card_id = card_id.replace(/\D/g,'').replace(/....(?!$)/g,'$& ');
			var b_len = card_id.length,
				bRIcon = $("#bRIcon");
			if(b_len==0){
				bRIcon.addClass("active").show().siblings().hide();
				this.imbox.hide();
				this.bankName.hide();
			}else if(b_len==1){
				bRIcon.removeClass("active").hide().siblings().show().removeClass("active");	
			}else if(b_len==18){
							
			}else if(b_len==19){
				var bank_type=TOOLS.isBank(card_id.replace(/\s+/g,""));
				if(bank_type){
					this.boxFlag=1;
					this.imbox.show();
				}
			}else if(b_len<12){	
				this.imbox.hide();
				this.boxFlag=0;
				this.bankName.hide();
			}else if(b_len>=12){
				var bank_type=TOOLS.isBank(card_id.replace(/\s+/g,""));
				if(bank_type){
					this.bankName.find("span").removeClass();
					this.bankName.find("span").addClass("bankName "+bank_type);
					this.bankName.show();
					
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
						this.imbox.hide();
						this.bankName.hide();
						this.idCardInput.val("");
						this.mobileInput.val("");
					}
					next.attr("disabled","disabled");
				}else{
					$('#'+intype).val("");
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
				bcflag = TOOLS.isCard(zCard.replace(/\s+/g,""));
				smBtn = $("#next2");

			if(this.boxFlag){
				if(zCard_len != 19 && zCard_len == 23 || zCard_len != 23 && zCard_len == 19){
					if(bcflag){
						if(age){
							if(age>30 || age<16){
								MessageBox.alert({type:"common",txt:CS.ERRORMSG["AGENOTRANGEERROR"]});
							}else{
								if(phone){
									/*提交*/	
									if(smBtn.hasClass("disabled")) return false;
									smBtn.addClass('disabled');			 					
									TOOLS.ajax({
										url:"./index.php",
										data:{name:zName,bank_card:zCard,id_card:zIdCard,mobile:zMobile,type:2},
										type:"get",
										fnSuccess:function(data){
											console.log(data);
											if(data.code == "1"){
												window.location="http://www.baidu.com";
											}else if(data.code == "2"){
												MessageBox.alert({type:"message",txt:CS.ERRORMSG["TWOCHANCE"],cls:true});
												smBtn.removeClass("disabled");	
											}else if(data.code == "3"){
												window.location="http://www.baidu.com";
											}
											
										},
										fnError:function(){}
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
					MessageBox.alert({type:"common",txt:CS.ERRORMSG["BANKCARDERROR"]});
				}
			}else{
				if(zCard_len != 19 && zCard_len == 23 || zCard_len != 23 && zCard_len == 19){
					if(bcflag){

					}else{
						MessageBox.alert({type:"common",txt:CS.ERRORMSG["BANKCARDERROR"]});
					}
				}else{
					MessageBox.alert({type:"common",txt:CS.ERRORMSG["BANKCARDERROR"]});
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