/**
 * 
 * Application loan
 * 
 * By shine
 * 
 * 20150529
 */

(function($, undefined){
	'use strict';
	
	var money = [1000,2000,3000,4000,5000,6000,7000,8000,9000,10000],
		time  = [100,200,300],
		//dfm = 3000,//贷款默认值
		dtm = 200,//天数默认值
		dl  = rate,//利率默认值
		offsetW = document.body.offsetWidth || document.body.clientWidth,
		poffsetw = (offsetW-30) * 0.8;//进度条的总宽度
	
	var Loan = function(el){
		this.parents = $(el);
		this.moneyNode = $("#applyMoney");
		this.timeNode = $("#applyTime");
		this.moneyProgressNode = $("#applyMoney").find(".progressBar");
		this.timeProgressNode = $("#applyTime").find(".progressBar");
		this.submitBtn = $("#applicationBtn");
		this._addEvents();
	}
	
	Loan.prototype = {
		//事件绑定
		_addEvents:function(){
			var self = this.parents;
			$("#repayTmpl").on("repay:change", function(){
				repayChange();
			})
			
			$("#repayTmpl").trigger("repay:change");
			
			var $crid = $("#changeRecharge"),
				$cal = $("#changeCal");
			
			var events = 'swipeleft swiperight dragleft dragright release';
			
			$crid.hammer({ drag_lock_to_axis: true })
				.on(events, $.proxy(this._eventHandler, this));
			
			$cal.hammer({ drag_lock_to_axis: true })
				.on(events, $.proxy(this._timeEventHandler, this));
		},
		//贷款进度处理
		_eventHandler:function(ev){
			ev.gesture.preventDefault();
			var oricw = !!this.moneyProgressNode.attr("data-px") ? this.moneyProgressNode.attr("data-px") : poffsetw/3;
			switch(ev.type) {
				case 'dragright':
//					var deltaX = ev.gesture.deltaX,
//						sw = parseInt(deltaX) + parseInt(oricw);
//					var _p = sw/poffsetw*100+"%";
//					this.moneyProgressNode.css({width:_p});
//					console.log(1);
//					break;
				case 'dragleft':
					console.log('dragleft');
					break;
				case 'swipeleft':
					console.log('swipeleft');
					break;
				case 'swiperight':
					var deltaX = ev.gesture.deltaX,
						sw = parseInt(deltaX) + parseInt(oricw);
					var _p = sw/poffsetw*100+"%";
					this.moneyProgressNode.css({width:_p});
					break;
				case 'release':
					var deltaX = ev.gesture.deltaX;
					var cw = this._calpercent('applyMoney'),
						sw = deltaX + cw;
					
					if(sw<=0){
						sw = 0;
						dfm = 1000;
						this.moneyProgressNode.css({width:"0%"});
						this.moneyNode.find('em').text(["￥",1000].join(""));
					} else {
						if(sw>=poffsetw) sw = poffsetw;
						
						var tp = ev.gesture.direction=="right" ? Math.ceil(sw/poffsetw*9) : Math.floor(sw/poffsetw*9);
						
						var money = (tp+1) * 1000;
						if(money>maxlimit){
							money = maxlimit;
						}
						dfm = money;
						this.moneyNode.find('em').text(["￥",money].join(""));
						
						if(tp>9) tp = 9;
						
						this.moneyProgressNode.css({width:(poffsetw/9*tp)/poffsetw*100+"%"});
					}
					
					this.moneyProgressNode.attr("data-px", poffsetw/9*tp);
					
					repayChange();
					
					break;
			}
		},
		//事件进度处理
		_timeEventHandler:function(ev){
			ev.gesture.preventDefault();
			switch(ev.type) {
				case 'dragright':
					break;
				case 'dragleft':
					break;
				case 'swipeleft':
					break;
				case 'swiperight':
					break;
				case 'release':
					var deltaX = ev.gesture.deltaX;
					var cw = this._calpercent('applyTime'),
						sw = deltaX + cw;
					
					if(sw<=0){
						dtm = 100;
						this.timeProgressNode.css({width:"0%"});
						this.timeNode.find('em').text([100,"天"].join(""));
					} else {
						if(sw>=poffsetw) sw = poffsetw;
						
						var tp = ev.gesture.direction=="right" ? Math.ceil(sw/poffsetw*2) : Math.floor(sw/poffsetw*2);;
						
						dtm = (tp+1)*100;
						
						this.timeNode.find('em').text([dtm,"天"].join(""));
						
						if(tp>2) tp = 2;
						
						this.timeProgressNode.css({width:(poffsetw/2*tp)/poffsetw*100+"%"});
					}
					
					repayChange();
					
					break;
			}
		},
		//计算宽度
		_calpercent:function(id){
			var node = $("#"+id).find(".progressBar"),
				_pwidth = node[0].style.width,
				_width = parseInt(_pwidth) * poffsetw/100;
			
			return _width;
		}
	}
	
	$.fn.Loan = function(options){
		new Loan(this);
	}
	
	function cal(m, t, l){
		if($.inArray(m, money)>-1 && $.inArray(t, time) > -1){
			return m + m * t * l;
		}
		
		return 0;
	}
	
	function repayChange(){
		$("#repayTmpl").find("p").text([dtm,'天后到期'].join(""))
			.end()
			.find('em')
			.text(["￥", cal(dfm, dtm, dl)].join(""));
		
		$('[name="duration"]').val(dtm);
		$('[name="money"]').val(dfm);
	}
	
})(window.jQuery||window.Zepto);