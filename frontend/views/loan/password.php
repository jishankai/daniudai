<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html charset=utf-8 "/>
	<title>设置提现密码</title>
<style>
    .wraper{width: 240px;margin: 0 auto;}
    h3{font-size: 0.825rem;margin-top: 10%;color: #7b7b7b}
    input{width:200px;padding:5px 20px;text-align: left;letter-spacing:20px;margin-bottom: 10px;
      font-size: 24px;display:block;}
    .btn{width: 240px;height: 50px;text-align: center;
      line-height: 40px;font-size: 18px;border: none;text-align: 
      display: block;background-color: #45c01a;color: #fff;
      text-decoration: none;letter-spacing: 5px;}
    .btn[disable]{background-color: #eee;}
    .two{display: none;}
    .error{width:180px;height: 50px;line-height: 50px;
      background-color: #222;color:#fff;border-radius: 10px;
      text-align: center;margin: 0 auto;display: none;}
</style>
</head>
<body>
<div class="wraper one">
	<h3>为了保障您的资金安全，请设置提现密码</h3>
	<input type="password" maxlength="6" id="pass"/>
  <input type="button" value="下一步" class="btn" id="next" />
</div>
<div class="wraper two">
  <form>
  <h3>请再次填写以确认</h3>
  <input type="password" maxlength="6" name="password" id="cpass"/>
  <input type="button" value="完成" class="btn" id="complete" />
  <input type="submit" style="display:none;" id="cc" />
  </form>
</div>
<div class="error"></div>
</body>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript">
$("#next").click(function(){
  pass=$("#pass").val();
  RegCellPass = /^([0-9]*)?$/;
  falg=pass.search(RegCellPass);
  pass_len=pass.length;
  if(falg==-1 || pass_len!=6){
    $(".error").html("请输入六位数字密码");
    $(".error").show();
    $("#pass").click(function(){
      $(".error").hide();
    })
    $("#pass").focus();
  }else{
    $(".one").hide();
    $(".two").show();
  }
});

$("#complete").click(function(){
  pass=$("#pass").val();
  cpass=$("#cpass").val();
  if(pass!=cpass){
    $(".error").html("密码输入不一致");
    $(".error").show();
    $("#cpass").click(function(){
      $(".error").hide();
    })
    $("#cpass").focus();
  }else{
    $("#cc").click();
  }

})
</script>
</html>