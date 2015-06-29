/**
 * All Tools 
 * 
 * TOOLS.isIdentity(id)  身份证号是否合法
 * TOOLS.isMobile(id)    手机号是否合法
 * TOOLS.isCard(id)		 银行卡号是否合法
 * TOOLS.isBank(id)		 属于银行(卡号必须大于6位以上才能调用) 
 */
var TOOLS = (function(){
	var isLocalStorage = !!window.localStorage ? true : false;
	return {
		isIdentity:isCnNewID,
		isMobile:isMobile,
		isCard:isCard,
		isBank:isBank,
		getItem:getItem,
		setItem:setItem,
		ajax:_ajax
	}
	
	//判断身份证合法
	function isCnNewID(cid){
	    var arrExp = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
	    var arrValid = [1, 0, "X", 9, 8, 7, 6, 5, 4, 3, 2];
	    var reg = /^\d{17}\d|x$/i;
	    if(reg.test(cid)){
	        var sum = 0, idx;
	        for(var i = 0; i < cid.length - 1; i++){
	            sum += parseInt(cid.substr(i, 1), 10) * arrExp[i];
	        }
	        idx = sum % 11;
	        if(arrValid[idx] == cid.substr(17, 1).toUpperCase()){
	        	var brithday = cid.substring(6,10),
	        		tDate = new Date(),
	        		tYear = tDate.getFullYear();
	        	
	        	return tYear - brithday;
	        } else {
	        	return false;
	        }
	    }else{
	        return false;
	    }
	}
	//判断手机号合法
	function isMobile(m){
		var reg = /^0?(13[0-9]|15[012356789]|18[0236789]|14[57]|17[0-9])[0-9]{8}$/;
		return m.search(reg)==0 ? true : false;
	}
	//判断身份证是否合法
	function isCard(bankno){
		var strBin="00,10,18,30,35,37,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,58,60,62,65,68,69,84,87,88,90,94,95,98,99";    
		if (strBin.indexOf(bankno.substring(0, 2))== -1) {
			return false;
		}
        var lastNum=bankno.substr(bankno.length-1,1);
        var first15Num=bankno.substr(0,bankno.length-1);
        var newArr=new Array();
        for(var i=first15Num.length-1;i>-1;i--){
            newArr.push(first15Num.substr(i,1));
        }
        var arrJiShu=new Array();
        var arrJiShu2=new Array();
        
        var arrOuShu=new Array();
        for(var j=0;j<newArr.length;j++){
            if((j+1)%2==1){
                if(parseInt(newArr[j])*2<9)
                arrJiShu.push(parseInt(newArr[j])*2);
                else
                arrJiShu2.push(parseInt(newArr[j])*2);
            }
            else
            arrOuShu.push(newArr[j]);
        }
        
        var jishu_child1=new Array();
        var jishu_child2=new Array();
        for(var h=0;h<arrJiShu2.length;h++){
            jishu_child1.push(parseInt(arrJiShu2[h])%10);
            jishu_child2.push(parseInt(arrJiShu2[h])/10);
        }        
        
        var sumJiShu=0;
        var sumOuShu=0;
        var sumJiShuChild1=0;
        var sumJiShuChild2=0;
        var sumTotal=0;
        for(var m=0;m<arrJiShu.length;m++){
            sumJiShu=sumJiShu+parseInt(arrJiShu[m]);
        }
        
        for(var n=0;n<arrOuShu.length;n++){
            sumOuShu=sumOuShu+parseInt(arrOuShu[n]);
        }
        
        for(var p=0;p<jishu_child1.length;p++){
            sumJiShuChild1=sumJiShuChild1+parseInt(jishu_child1[p]);
            sumJiShuChild2=sumJiShuChild2+parseInt(jishu_child2[p]);
        }      
        sumTotal=parseInt(sumJiShu)+parseInt(sumOuShu)+parseInt(sumJiShuChild1)+parseInt(sumJiShuChild2);
        
        var k= parseInt(sumTotal)%10==0?10:parseInt(sumTotal)%10;        
        var luhm= 10-k;
        
        if(lastNum==luhm){
	        return true;
        }
        else{
        	return false;
        }        
    }
	
	function isBank(bankno){
		var kbin = bankno.substring(0, 6),
			kbin5 = bankno.substring(0, 5);
        
		return !!lists[kbin] ? lists[kbin] : (!!lists[kbin5] ? lists[kbin5] : false);
	}
	
	function _ajax(options){
		try {
			$.ajax({
				url:options.url,
				data:options.data,
				dataType:options.dataType,
				type:!!options.type?options.type:"post",
				success:options.fnSuccess,
				error:options.fnError
			})
		} catch (e) {
			alert("出现错误");
		}
	}
	//本地记录错误次数
	function getItem(){
		//如果支持H5
		if(isLocalStorage){
			var storage = window.localStorage;
			
			if (!storage.getItem("errorCount")) storage.setItem("errorCount",0);
			return storage.getItem("errorCount");
		} else {
			
		}
	}
	//本地记录错误次数
	function setItem(){
		if(isLocalStorage){
			var storage = window.localStorage;
			
			if (!storage.getItem("errorCount")){
				storage.setItem("errorCount",1);
			} else {
				storage.errorCount = parseInt(storage.getItem("errorCount")) + 1;
			}
		} else {
			
		}
	}
})();