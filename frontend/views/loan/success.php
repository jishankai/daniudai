<!DOCTYPE html>
<html class="mobile-notes-variant" lang="en"><!--full-srceen-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" user-scalable="no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>申请通过</title>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-precomposed-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-precomposed-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/logo-72.png">
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/base.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/fonts.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/widget.css" />
</head>
<body>
	<div class="container">
		<div class="screen-content">			
			<div class="content">
				<div class="success-box s-bgcolor">				
					<div class="s-title">
						<img src="img/success.png" />
						<h1>恭喜恭喜，<span>您的申请已提交！</span></h1>
					</div>
					<p>
						请等待校园金融专员与您联系!<br />
                        真牛君电话：<span class="mail" id="phone"><?php echo $mobile?></span>，正飞奔而来...
					</p>
				</div>
			</div>
		</div>
	</div>	
</body>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
     wx.config(<?php echo $js->config(array('hideOptionMenu'), false, true) ?>);
     wx.ready(function(){
         wx.hideOptionMenu();
     });
 </script>
</html>






