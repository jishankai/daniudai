<?php use yii\helpers\Url;?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width = device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>待放款用户列表</title>
	<style type="text/css">
		th{height: 30px;}
		td{height: 26px;text-align: center;line-height: 26px;}
		tr > td:nth-of-type(1){width: 20%;}
		tr > td:nth-of-type(2){width: 25%;}
		tr > td:nth-of-type(4){width: 16%;}
	</style>
</head>
<body>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th>姓 名</th>
			<th>银行类别</th>
			<th>卡号</th>
			<th>
            <?php if($verification=='admin') {?>
            操作
            <?php } else {?>
            状态
            <?php }?>
            </th>
		</tr>
        <?php foreach($r AS $v) {?>
		<tr>
        <td><?php echo $v['name']?></td>
        <td><?php echo $v['bank']?></td>
        <td><?php echo $v['bank_id']?></td>
            <?php if($verification=='admin') {?>
            <td><a href="<?php echo Url::to(['loan/operate','loan_id'=>$v['loan_id'],'operation'=>3])?>"><button>确认</button></a></td>
            <?php } else {?>
            <td>未放款</td>
            <?php }?>
        </tr>
        <?php }?>
	</table>
</body>

</html>
