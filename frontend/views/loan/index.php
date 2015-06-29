<?php use yii\helpers\Url;?>
<!DOCTYPE html>
<html class="mobile-notes-variant bg-color" lang="en"><!--full-srceen-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" user-scalable="no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>大牛贷</title>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-precomposed-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-precomposed-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/logo-72.png">
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css?<?php echo $v; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/base.css?<?php echo $v; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/fonts.css?<?php echo $v; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/widget.css?<?php echo $v; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="css/attach.css?<?php echo $v; ?>" />
</head>
<body>
	<div class="container">
		<div class="screen-content">			
			<div class="content">
				<div class="loan-box">
					<img class="loan-picImg" src="img/pic-01.jpg" />
					<div class="loan-content">
						<h2>信用贷款</h2>
						<p>只要你是在校大学生，用大牛贷，纯信用</p>
						<h2>超低利率</h2>
						<p>远低于市场上的信用贷款，日利率仅0.03%</p>
						<h2>不是分期，是到期哟~</h2>
						<p>100天，200天，300天，取你所需，到期才还</p>
					</div>
					<form class="forms">
		                <div class="forms__option ljjh clearfix">
		                	<a class="btn btn-white" href="<?php echo Url::to(['loan/lend'])?>">立即激活</a>
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
