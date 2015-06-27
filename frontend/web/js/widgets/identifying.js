/**
 * 
 * check of identifying code 
 * 
 * 
 * 
 * 20150623
 */
 (function($, undefined){
 	//生产类
 	var Pub = function(el, op){
 		this.$el = $(el);
 		this.captchaInput = this.$el.find('[node-type="LoanCaptchaInput"]');
 		this.sendBtn = this.$el.find('[node-type="LoanSendBtn"]');
 		this.confirmBtn = this.$el.find('[node-type="LoanConfirmBtn"]');
 		this.phone = $("#phone").val();
 		this.idCode = $("#idCode").val();
 		this._addEvents();
 	}

 	Pub.prototype = {
 		//初始化
 		_init : function(){

 		},
 		//所有事件绑定
 		_addEvents : function(){
 			var sthis = this;
 			/*验证码输入判断*/
 			this.captchaInput.on('keyup', function(){
 				var idCode_var = this.value;
 				this.value = sthis._fnCaptcha(idCode_var);
 			})
 			/*获取验证码按钮*/
 			this.sendBtn.on('click', function(){
 				var times = 59,
 					send = $(this);
 				sthis._fnObtain(times,send);
 			})
 			/*确定按钮*/
 			this.confirmBtn.on('click', function(){
 				var confirmBtn = $(this);
 				sthis._fnSubmit(confirmBtn);
 			})

 		},
 		/*验证码处理*/
 		_fnCaptcha : function(idCode_var){
 			idCode_var = idCode_var.replace(/\D/g,'');
			var idCode_len = idCode_var.length;
			if(idCode_len==0){
				this.confirmBtn.addClass("disabled");
			}else if(idCode_len==6){
				this.confirmBtn.removeClass("disabled");
			}
			return idCode_var;
 		},
 		_fnObtain : function(times,send){
 			var timer = null;
 			if(send.hasClass("disabled")) return false;
 			send.addClass('disabled');
 			timer = setInterval(function(){
 				send.html("重新获取("+times+")");
 				if(times < 0){
 					send.html("获取验证码");
 					send.removeClass('disabled');
 					times = 59;
 					clearInterval(timer);
 				}
 				times--;
 			},1000);

 			TOOLS.ajax({
 				url:"./index.php?loan/sms",
 				data:{mobile:this.phone,code:1},
 				type:"get",
 				dataType:"json",
 				fnSuccess:function(data){
 				},
 				fnError:function(){}
 			});
 		},
 		_fnSubmit : function(confirmBtn){
 			if(confirmBtn.hasClass("disabled")) return false;
 			confirmBtn.addClass('disabled');
 			TOOLS.ajax({
 				url:"./index.php?loan/sms",
 				data:{mobile:this.phone,code:this.idCode,type:1},
 				type:"get",
 				dataType:"json",
 				fnSuccess:function(data){
 					console.log(data);
 					if(data.isSuccess == "0"){
 						confirmBtn.removeClass('disabled');
 						MessageBox.alert({type:"common",txt:CS.ERRORMSG["CAPTCHAERROR"]});
 					}else if(data.code == "1"){
 						window.location="./index.php?loan/success";
 					}
 				},
 				fnError:function(){}
 			});
 		}
 	}

 	$.fn.PUB = function(options){
 		return this.each(function(){
 			var $this = $(this) ,
 				data = $this.data('PUB');

 			if(!data){
 				$this.data('PUB', (data = new Pub(this, options)))
 			}

 			if(typeof options == 'string') data[options](setData);
 		});
 	}
 })(window.jQuery||window.Zepto)













