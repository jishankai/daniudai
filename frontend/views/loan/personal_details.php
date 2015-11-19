<?php use yii\helpers\Url;?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width = device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>个人信息</title>
	<style type="text/css">
		.wraper{width:96%;padding:4%;}
		table{margin: 0 auto;}
		th{height: 30px;width:100px;}
		td{height: 30px;text-align: center;line-height: 26px;
			width: 40%;}
		tr > td:nth-of-type(2n){width: 20%;}
		.btn{text-decoration: none;color: #000;
			display: inline-block;width: 40%;height: 50px;
			background-color: orange;line-height: 50px;
			text-align: center;margin: 20px 0;
			margin-left: 5%;
			border-radius: 10px;box-shadow:2px 2px 6px #aaa;}
	</style>
</head>
<body>
<div class="wraper">
	<table border="1" cellpadding="0" cellspacing="0" width="96%">
		<tr>
			<th>姓名</th>
            <td><?php echo $r['name']?></td>
		</tr>
		<tr>
			<th>学号</th>
            <td><?php echo $r['stu_id']?></td>
		</tr>
		<tr>
			<th>身份证号码</th>
            <td><?php echo $r['id']?></td>
		</tr>
		<tr>
			<th>专业</th>
            <td><?php echo $r['depart']?></td>
		</tr>
		<tr>
			<th>借款额</th>
            <td><?php echo $r['money']?></td>
		</tr>
		<tr>
			<th>借款期限/天</th>
            <td><?php echo $r['duration']?></td>
		</tr>
		<tr>
			<th>通道</th>
            <td><?php echo ($r['rate']==0.0001)?'毕业生':'普通'?></td>
		</tr>
		<tr>
			<th>手机</th>
            <td><?php echo $r['mobile']?></td>
		</tr>
		<tr>
			<th>宿舍</th>
            <td><?php echo $r['dorm']?></td>
		</tr>
		
	</table>
    <br />
    <br />
    <br />
    <a class="btn" href="<?php echo Url::to(['loan/operate','loan_id'=>$r['loan_id'],'operation'=>2])?>" onclick= "if(confirm( '是否确定通过审核！ ')==false)return false; ">确认通过审核</a>
    <a class="btn" href="<?php echo Url::to(['loan/operate','loan_id'=>$r['loan_id'],'operation'=>-1])?>" onclick= "if(confirm( '是否确定审核未通过！ ')==false)return false; ">审核未通过</a>
</div>
</body>
</html>
