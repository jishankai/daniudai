/**
 * 
 * identity verification 
 * 
 * 
 * 
 * 20150813
 */
 (function($, undefined){
 	//生产类
 	var Puf = function(el, op){
 		this.$el = $(el);
 		this.nameInput = $("#name");
 		this.idCardInput = $("#id_card");
 		this.nextBtn = $("#a_next");
 		this._addEvents();
 	}

 	Puf.prototype = {
 		//初始化
 		
 		_init : function(){
 			
 		},
 		//所有事件绑定
 		_addEvents : function(){
 			var sthis = this;

 			/*身份证号输入判断*/
			this.idCardInput.on("keyup", function(){
				var idCard_val = this.value;
				this.value = sthis._fnIdentity(idCard_val);
			})

			/*判断信息完整*/
			this.$el.find("input").on("input", function(){
				sthis._fnComplete();				
			})

			/*下一步按钮*/
			this.nextBtn.on("click", function(){
				var name = sthis.nameInput.val(),
					cid = sthis.idCardInput.val(),
					nextBtn = this;
				sthis._fnSubmit(nextBtn,name,cid);
			})

 		},

 		//身份证处理
		_fnIdentity : function(idCard_val){
			idCard_val=idCard_val.replace(/[^\d|xX]/g,"");
			return idCard_val;
		},
		//表单处理
		_fnComplete : function(){
			var ipt=this.$el.find("input"),
				ipt_flag=1,
				ipt_len=2;

			for(var i=0; i<ipt_len; i++){
				if(ipt[i].value.length == 0){       
					ipt_flag=0;
				}
			}
			if(ipt_flag==1){
				this.nextBtn.removeClass("disabled");
				this.nextBtn.removeAttr("disabled");
			}else{
				this.nextBtn.addClass("disabled");
				this.nextBtn.attr("disabled","disabled");
			}	 
		},
 		_fnSubmit : function(nextBtn,name,cid){
 			var flag,
 				age = TOOLS.isIdentity(cid);

			RegCellName = /^[\u4e00-\u9fa5\·\•\●]*$/;
			name_falg=name.search(RegCellName);
			if(name.length<2 || name_falg=="-1"){
				falg=-1;
			}else{
				falg=0;
			}

			if(falg==-1){
				MessageBox.alert({type:"common",txt:"请输入真实姓名！"});
				$("#name").focus();
				if(cid.length<18){
					MessageBox.alert({type:"common",txt:"请输入18位身份证号！"});
					if(!age){
						MessageBox.alert({type:"common",txt:"身份证号不合法！"});
					}else{
						alert("success!");
					}
				}
				 //写表单提交代码
				/*if(nextBtn.hasClass("disabled")) return false;
					nextBtn.addClass('disabled');
				TOOLS.ajax({
					url:"./index.php?r=loan/auth",
					data:{name:name,cid:cid},
					type:"post",
					dataType:"json",
					fnSuccess:function(data){
						if(data.stat == "1"){
							window.location.href="./index.php?r=loan/password&type="+data.type;
						}else if(data.stat == "2"){
							nextBtn.removeClass('disabled');
	        				MessageBox.alert({type:"common",txt:"身份验证失败！"});
						}
					},
					fnError:function(){}
				});*/
			}
 		}
 	}

 	$.fn.PUF = function(options){
 		return this.each(function(){
 			var $this = $(this) ,
 				data = $this.data('PUF');

 			if(!data){
 				$this.data('PUF', (data = new Puf(this, options)))
 			}

 			if(typeof options == 'string') data[options](setData);
 		});
 	}
 })(window.jQuery||window.Zepto)













