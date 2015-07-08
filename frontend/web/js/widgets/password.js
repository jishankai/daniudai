/**
 * 
 * check of identifying code 
 * 
 * 
 * 
 * 20150708
 */
 (function($, undefined){
 	//生产类
 	var Puc = function(el, op){
 		this.$el = $(el);
 		this.opwdInput = this.$el.find('[node-type="LoanOpwdInput"]');
 		this.spwdInput = this.$el.find('[node-type="LoanSpwdInput"]');
 		this.cpwdInput = this.$el.find('[node-type="LoanCpwdInput"]');
 		this.opwdBox = $("#opwdBox");
 		this.pwd = $(".forms_input");
 		this.pwdnext = $("#next");
 		this.sxflag = $("#s_x");

 		this._addEvents();
 	}

 	Puc.prototype = {
 		//初始化
 		
 		_init : function(){
 			
 		},
 		//所有事件绑定
 		_addEvents : function(){
 			var sthis = this,
 				sxflag_val = this.sxflag.html();
 				if(sxflag_val=="1"){
 					this.opwdBox.show();
 				}else{
 					this.opwdBox.hide();
 				}

 			/*判断信息完整*/
			this.$el.find("input").on("input", function(){
				sthis._fnComplete();				
			})
		
 			//密码输入判断
 			this.pwd.on('keyup', function(){
 				var pwd_val = this.value;
 				this.value = sthis._fnPwd(pwd_val);
 			})

 			// 下一步按钮
 			this.pwdnext.on('click', function(){
 				var opwd = sthis.opwdInput.val(),
 					spwd = sthis.spwdInput.val(),
 					cpwd = sthis.cpwdInput.val(),
 					pflag = 0,
 					sxflag = sthis.sxflag.val();
 				if(spwd!=cpwd){
 					pflag = 1;
 				}else if(spwd.length!=6){
 					pflag = 2;
 				}
 				sthis._fnSubmit(pflag,opwd,spwd,cpwd,sxflag);
 			
 			})
 			

 		},
 		/*密码处理*/
 		_fnPwd : function(pwd_val){
 			pwd_val = pwd_val.replace(/\D/g,'');
 			return pwd_val;
 		},

 		_fnSubmit : function(pflag,opwd,spwd,cpwd,sxflag){
 			var confirmBtn = this.pwdnext;
 			if(pflag==0){
 				if(confirmBtn.hasClass("disabled")) return false;
	 			confirmBtn.addClass('disabled');
 				if(sxflag){	
	 				TOOLS.ajax({
	 					url:"./index.php?r=loan/password",
	 					data:{opwd:opwd,spwd:spwd,cpwd:cpwd},
	 					type:"post",
	 					dataType:"json",
	 					fnSuccess:function(data){
	 						if(data.stat == "1"){
	 							window.location="http://www.baidu.com";
	 						}else if(data.stat == "2"){
	 							MessageBox.alert({type:"common",txt:"原始密码错误！"});
	 							confirmBtn.removeClass("disabled");	
	 						}
	 					},
	 					fnError:function(){}
	 				});
	 			}else{
	 				TOOLS.ajax({
	 					url:"./index.php?r=loan/password",
	 					data:{spwd:spwd,cpwd:cpwd},
	 					type:"post",
	 					dataType:"json",
	 					fnSuccess:function(data){
	 						if(data.stat == "1"){
	 							window.location="http://www.baidu.com";
	 						}
	 					},
	 					fnError:function(){}
	 				});
	 			}
 			}else if(pflag==1){
 				MessageBox.alert({type:"common",txt:"两次密码输入不一致"});
 			}else if(pflag==2){
 				MessageBox.alert({type:"common",txt:"请输入6位数字密码"});
 			}
 		},

 		//表单处理
		_fnComplete : function(){
			var ipt=this.$el.find("input"),
				ipt_flag=1;
			for(var i=0; i<ipt.length; i++){
				if(ipt[i].value.length == 0){       
					ipt_flag=0;
				}
			}
			if(ipt_flag==1){
				this.pwdnext.removeClass("disabled");
			}else{
				this.pwdnext.addClass("disabled");
			}	 
		}
 	}

 	$.fn.PUC = function(options){
 		return this.each(function(){
 			var $this = $(this) ,
 				data = $this.data('PUC');

 			if(!data){
 				$this.data('PUC', (data = new Puc(this, options)))
 			}

 			if(typeof options == 'string') data[options](setData);
 		});
 	}
 })(window.jQuery||window.Zepto)













