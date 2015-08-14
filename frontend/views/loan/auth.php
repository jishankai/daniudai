<!DOCTYPE html>
<html class="mobile-notes-variant" lang="en"><!--full-srceen-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" user-scalable="no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>身份验证</title>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-precomposed-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-precomposed-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/logo-72.png">
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css?<?php echo $v?>" />
<Link rel="stylesheet" type="text/css" media="all" href="css/base.css?<?php echo $v?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/fonts.css<?php echo $v?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/widget.css<?php echo $v?>" />
</head>
<body>
	<div class="container">
		<div class="screen-content">			
			<div class="content">
				<div class="info-box">					
					<form class="forms">
						<div class="forms-item forms-psdNew">
							<div class="forms__group">
			                    <label class="forms__label">姓名</label>
			                    <span class="input__box">             
			                        <input type="text" class="forms_input" placeholder="登记的姓名" value="">	
			                    </span>			                    
			                </div>		                
							<div class="forms__group">
			                    <label class="forms__label">身份证号</label>
			                    <span class="input__box no-border">             
			                        <input type="text" class="forms_input" placeholder="登记的身份证号" value="">	
			                    </span>
			                </div>			                
		                </div> 
		                <div class="forms__option">
		                	<button class="btn btn-primary disabled btn-fullwidth">下一步</button>
		                </div>                                              
		            </form>
				</div>
			</div>
		</div>		
	</div>	
</body>
      
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
     wx.config(<?php echo $js->config(array('hideOptionMenu'), false, true) ?>);
     wx.ready(function(){
         wx.hideOptionMenu();
     });
 </script>
</html>
