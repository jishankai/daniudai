/**
 * API
 * 
 * MessageBox.alert({type:"message",txt:"该卡暂时不支持，请用其他卡"});
 * MessageBox.alert({type:"common",txt:"请输入正确的身份证号"});
 * 
 */
var MessageBox = MessageBox || (function($, undefined){
	var $el = $("#container"),
		$masker = $el.find("#masker"),
		$common_masker = $el.find("#common_masker"),
		$message_masker = $el.find("#message_masker"),
		$confirmBtn = $el.find("#confirmBtn");
	
	
	function depatch(options){
		switch(options.type){
			case "common":
				setCommonErrorTxt(options);
				break;
			case "message":
				setMessageErrorTxt(options);
				break;
		}
	}
	
	function setCommonErrorTxt(options){
		var time = !!options.time ? options.time : 2000;
		$common_masker.show().find("p").text(options.txt);
		var timeout = setTimeout(function(){
			$common_masker.hide();
		}, time);
	}
	
	function setMessageErrorTxt(options){
		$masker.show();
		$message_masker.show().find("p").html(options.txt);

		setTimeout(function(){
			var width = $message_masker.width();
		
			$message_masker.attr("style",'display:block;top:20%;position:absolute;left:50%;margin-left:'+-width/2+"px"+'');
			if(!!options.cls){
				$message_masker.find('.message-box').addClass("m-icon");
			}
			if($.isFunction(options.fn)){
				options.fn();
			}
		}, 200)
		
	}
	
	function addEvents(){
		$masker.on("masker:hide", function(){
			$masker.hide();
		})
		$masker.on("masker:show", function(){
			$masker.show();
		})
		$message_masker.on("masker:hide", function(){
			$message_masker.hide();
		})
		$confirmBtn.on("click", function(){
			$masker.trigger("masker:hide");
			$message_masker.trigger("masker:hide");
		})
	}
	
	addEvents();
	
	return {
		alert:depatch
	}
	
})(window.jQuery || window.Zepto);