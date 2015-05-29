<?php use yii\helpers\Url;?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width = device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>待审核人员名单</title>
	<style type="text/css">
		th{height: 30px;}
		td{height: 26px;text-align: center;line-height: 26px;}
	</style>
</head>
<body>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th>姓 名</th>
			<th>专 业</th>
			<th>手机号</th>
		</tr>
        <?php foreach($r AS $v) {?>
        <a href="<?php echo Url::to(['loan/person',['loan_id'=>$v['loan_id']])?>">
		<tr>
        <td><?php echo $v['name']?></td>
        <td><?php echo $v['depart']?></td>
        <td><?php echo $v['mobile']?></td>
        </tr>
        </a>
        <?php }?>
	</table>
</body>
</html>
