<?php use yii\helpers\Url;?>
<!DOCTYPE html>
<html class="mobile-notes-variant" lang="en"><!--full-srceen-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" user-scalable="no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>填写银行信息</title>
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
	<div class="container" id="container">
		<div class="screen-content">			
			<div class="content">
				<div class="info-box">	
					<div class="info-text"><p>请正确填写银行卡信息，以能够及时打款。</p></div>		
					<form class="forms" id="form2" action="" onsubmit="return false;">				                                   
		            	<div class="forms-item">							
			                <div class="forms__group">
			                    <label class="forms__label">姓名</label>
			                    <span class="input__box">                                   
			                        <input type="text" class="forms_input" readonly="readonly" placeholder="" value="<?php echo $user->name?>" id="name">
			                    </span>
			                </div>
			                <div class="forms__group">
			                    <label class="forms__label">卡号</label>
			                    <span class="input__box no-border">             
			                        <input type="tel" class="forms_input" placeholder="您本人的银行卡号" node-type="LoanCardInput" maxlength="23" id="bank_card" autocomplete="off" onpaste="return false;">
			                        <span class="icon-option" node-type="bank_card"><i class="icons icons-infoNew active" id="bRIcon"></i><i class="icons icons-cross" style="display:none;"></i></span>
			                    </span>
			                </div>			                
			            </div>
			            <div class="forms-item bank-match" style="display:none;" id="bank_name">
			            	<span class=""></span>
			            </div>
			            <div class="forms-item" style="display:none;" id="imbox">	
			                <div class="forms__group">
			                    <label class="forms__label">身份证</label>
			                    <span class="input__box">           
			                        <input type="text" class="forms_input" placeholder="身份证号" value="" maxlength="18" id="ID_card" node-type="LoanIdCardInput" autocomplete="off" onpaste="return false;">
			                        <span class="icon-option" node-type="ID_card"><i class="icons icons-cross" style="display:block;"></i></span>
			                    </span>
			                </div> 
			                <div class="forms__group">
			                    <label class="forms__label">手机号</label>
			                    <span class="input__box no-border">   
			                        <input type="tel" class="forms_input" placeholder="银行预留手机号码" id="mobile" maxlength="11" node-type="LoanMobileInput" autocomplete="off" onpaste="return false;">
			                        <span class="icon-option" node-type="mobile"><i class="icons icons-infoNew active" id="mRIcon"></i><i class="icons icons-cross" style="display:none;"></i></span>
			                    </span>
			                </div> 	
		                </div>
		                <div class="forms-item agreement active" style="display:none;" id="agreement-btn">
		                	<p class="text"><i class="icons icons-checkNew"></i>同意接受&nbsp;<a href="javascript:;">借款协议</a></p>      	
		                </div>
		             	                
		                <div class="forms__option">
		                	<button class="btn btn-primary btn-fullwidth" id="next2" disabled node-type="LoanSubmitBtn">下一步</button><!--disabled-->
		                </div>                                              
		            </form>
				</div>
			</div>
		</div>
		<div id="masker" class="masker" style="display:none;"></div>
		<div id="common_masker" class="popover popover-small" style="display:none;position: absolute; margin-left:-90px;"><!--提示消失opacity:0;显示位置margin:-20px 0 0 -90px;-->
			<div class="popover-inner">
				<div class="wrong-box">
					<p></p>				
				</div>
			</div>
		</div>
		<div id="message_masker" class="popover" style="display:none;position:absolute;top:20%;">
			<div class="popover-inner">
				<div class="message-box">
					<p></p>			
					<a href="javascript:;" id="confirmBtn" class="btn-option">确定</a> 		
				</div>
			</div>
		</div>
		<div id="loading_masker"class="popover popover-tiny" style="display:none;position: absolute;"><!--提示消失opacity:0;蒙层加上这个class  masker-60-->
			<div class="popover-inner">
				<img src="img/loader4.gif" id="loadingImg">
			</div>
		</div> 
		<div class="popover popover-big" style="display:none;position: absolute;left:0;" id="agreement">
			<div class="popover-inner">
				<div class="lists-box">					
					<div class="lists-title">
						<h3>借款协议</h3>
						<span class="close" id="close10">&times;</span>
					</div>
					<div class="lists-body alists-body" id="cbank-list">
						<div id="agree_list" class="agree_list">
							<p>
								甲方（出借人）：渠帅<br/>
								乙方（借款人）：<br/>
								姓名：<span id="c_name"></span><br/>
								身份证号：<span id="c_id"></span><br/>
								银行卡号：<span id="c_bid"></span><br/>

								丙方（见证人/技术服务方）：北京天天飞度信息技术有限公司<br/>
							</p>

							<p>
								鉴于：<br/>
								1、丙方是一家在北京市合法成立并有效存续的有限责任公司，拥有www.daniucredit.com网站的经营权，为交易提供信息服务，并协助甲乙双方进行本合同项下的借款回收及日常管理工作；<br/>
								2、乙方已通过网站或微信服务号在丙方注册，并承诺其提供给丙方的信息是完全真实的；<br/>
								3、甲方承诺对本协议涉及的借款具有完全的支配能力，是其自有闲散资金，为其合法所得；并承诺其提供给丙方的信息是完全真实的；<br/>
								4、乙方有借款需求，甲方亦同意借款，双方有意成立借贷关系。
								各方经协商一致，于【<span id="year"></span>】年【<span id="month"></span>】月【 <span id="day"></span>】日签订如下协议，共同遵照履行：</p>

								<p>
									第一条 借款基本信息<br/>
									借款金额：￥<?php echo $loan->money;?><br/>
									借款周期：	<?php echo $loan->duration;?>天<br/>
									到期还款金额：	￥<?php echo ($loan->money+$loan->money*$loan->duration*$loan->rate);?><br/>
									还款日：	自款项从甲方的银行账户或第三方支付账户转出之日起，100天后的日期。
								</p>
								<p>
									第二条 借款发放方式<br/>
									甲乙双方确认，本协议项下的借款以下列方式完成发放：<br/>
									甲方通过个人网银或第三方支付渠道将款项转入乙方在丙方绑定的银行卡账户。<br/>
									双方确认，款项一经从甲方的银行账户或第三方支付账户转出，即视为资金已经发放，借款协议成立，乙方不得以任何理由拒绝履行本协议项下的还款义务。
								</p>

								<p>
									第三条 各方权利和义务<br/>
									甲方的权利和义务：<br/>
									1.甲方应按协议在本协议签订日期或乙丙双方另行约定的其他日期将足额的借款本金支付给乙方。<br/>
									2.甲方保证其所用于出借的资金来源合法，甲方是该资金的合法所有人，如果第三人对资金归属、合法性问题发生争议，由甲方负责解决。如甲方未能解决，则放弃享有其所出借款项所带来的利息收益。<br/>
									3.甲方享有其所出借款项所带来的利息收益。<br/>
									4.如乙方违约，甲方有权要求丙方提供其已获得的乙方信息。<br/>
									5.无须通知乙方和丙方，甲方可以根据自己的意愿进行本协议下其对乙方债权的转让。在甲方的债权转让后，乙方仍应按照本协议的约定向债权受让人支付应还贷款本息，不得以未接到债权转让通知为由拒绝履行还款义务。<br/>
									6.甲方应主动缴纳由利息所得带来的可能的税费。<br/><br/>
									乙方权利和义务：<br/>
									1.乙方必须按时足额向甲方支付应还本金和利息。<br/>
									2.乙方必须足额向丙方支付相关服务费用（具体费用及约定见《天天飞度技术服务及信用管理服务合同》）<br/>
									3.乙方承诺所借款项不用于任何违法用途。<br/>
									4.乙方应确保其提供的信息和资料的真实性，不得提供虚假信息或隐瞒重要事实。<br/>
									5.乙方不得将本协议项下的任何权利义务转让给任何其他方。<br/>
									6.乙方不可撤销地授权北京天天飞度信息技术有限公司向第三方查询本人银行卡交易数据报告，用于评估信用状况，查询期限为申请贷款之日至所有贷款及相关款项全部结清之日或至申请贷款拒绝之日。<br/><br/>


									丙方的权利和义务：<br/>
									1.丙方作为技术服务方应依据其与甲方签署的《天天飞度咨询及管理服务协议》以及与乙方签署的《天天飞度技术服务及信用管理服务合同》，分别为甲方和乙方提供相应的技术服务和管理服务；<br/>
									2.甲方和乙方在履行本协议的过程中，应分别遵守其与技术服务方签署的《天天飞度咨询及管理服务协议》以及《天天飞度技术服务及信用管理服务合同》的规定。<br/>
									3.甲乙双方在此确认，技术服务方不是本协议规定的借贷关系的当事人；甲乙双方中的任何一方根据借贷关系向对方主张权利时，不得将技术服务方列为共同被告，也不得要求技术服务方承担连带责任。<br/>
								</p>
								<p>
									第四条 违约责任<br/>
									1.合同各方均应严格履行合同义务，非经各方协商一致或依照本协议约定，任何一方不得解除本协议。<br/>
									2.任何一方违约，违约方应承担因违约使得其他各方产生的费用和损失，包括但不限于调查、诉讼费、律师费等，应由违约方承担。如违约方为乙方的，甲方有权立即解除本协议，并要求乙方立即偿还未偿还的本金、利息、罚息、违约金。<br/>
									3.乙方的还款均应按照如下顺序清偿：<br/>
									（1）根据本协议产生的其他全部费用；<br/>
									（2）罚息；<br/>
									（3）逾期管理费；<br/>
									（4）拖欠的利息；<br/>
									（5）拖欠的本金；<br/>
									（6）正常的利息；<br/>
									（7）正常的本金；<br/>
									4.乙方应严格履行还款义务，如乙方逾期还款且丙方未替乙方垫付应还本息时，则应按照下述条款向甲方支付逾期罚息，自逾期开始之后，在利息照常计算的基础上加收；<br/>
									罚息总额 = 逾期本息总额×对应罚息利率×逾期天数；<br/>
									罚息利率：0.05%<br/>
									5.乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向丙方支付逾期管理费。<br/>
									逾期管理费总额 = 逾期本息总额×对应逾期管理费率×逾期天数；<br/>
									逾期管理费费率：0.02%<br/>
									6.如果乙方逾期支付还款超过30天，或甲方/丙方发现乙方出现逃避、拒绝沟通或拒绝承认欠款事实、故意转让资金、信用情况恶化等危害本协议借款的情形，本协议项下的全部借款本息提前到期，乙方应立即清偿本协议下尚未偿付的全部本金、利息、罚息及根据本协议产生的其他全部费用。丙方有权将乙方的“逾期记录”、“恶意行为”或“不良情况”记入公民征信系统，或将乙方违约失信的相关信息及乙方其他信息向媒体、用人单位、公安机关、检查机关、法律机关披露，丙方不承担任何法律责任<br/>
									7.在乙方还清全部本金、利息、罚息、逾期管理费之前，罚息及逾期管理费的计算不停止。
								</p>
								<p>
									第五条 提前还款<br/>
									本协议暂不支持提前还款。
								</p>
								<p>
									第六条 法律及争议解决<br/>
									本协议的签订、履行、终止、解释均适用中华人民共和国法律，并由丙方所在地的人民法院管辖。
								</p>
								<p>
									第七条 附则 <br/>
									1.本协议采用电子文本形式制成，并永久保存在丙方为此设立的专用服务器上备查，各方均认可该形式的协议效力。<br/>
									2.本协议自文本最终生成之日生效。<br/>
									3.如果本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。<br/><br/><br/>


									天天飞度技术服务及信用管理服务合同<br/><br/>

									本合同由以下双方于【<span id="year1"></span>】年【<span id="month1"></span>】月【 <span id="day1"></span>】日签署。<br/>
									乙方（借款人）：<?php echo $user->name?><br/>
									证件号码：<span id="c_id1"></span><br/>
									丙方：北京天天飞度信息技术有限公司<br/>
									地址：北京市朝阳区麦子店街37号盛福大厦550<br/>
									邮编：100125<br/>

									鉴于：<br/>
									乙方拥有短期融资的需求，丙方为北京市合法成立并有效存续的有限责任公司，拥有成熟的互联网金融信息技术、网络平台、风险管理等专业服务体系，根据《中华人民共和国合同法》，甲乙双方本着自愿、平等、公正的原则签署本合同。
									<p>
										第一条 服务内容与范围<br/>
										乙方自愿接受丙方提供的互联网金融技术服务及信用管理服务，丙方通过其服务平台为乙方持续提供技术服务及信用管理服务。乙方委托丙方，通过网络、电话提供如下技术服务，满足乙方需求：<br/>
										&nbsp;&nbsp;1）互联网金融信息技术服务<br/>
										&nbsp;&nbsp;2）互联网金融产品推荐与资金对接信息服务<br/>
										&nbsp;&nbsp;3）互联网金融风险管理技术服务<br/>
									</p>
									<p>
										第二条 乙方权利与义务<br/>
										1）乙方有权向丙方了解丙方提供的技术服务进度及结果；<br/>
										2）乙方在获取丙方技术服务的全过程中，必须真实准确向丙方提供所要求提供的个人信息，如乙方提供不真实信息或有意隐瞒重要信息，视为违约，须对丙方承担违约责任；<br/>
										3）乙方自愿成为丙方平台注册用户，授权丙方基于乙方提供的信息及丙方独立获取的信息管理乙方的信用信息；<br/>
										4）乙方同意，丙方依据资金提供方的委托协调乙方按照约定期限及金额进行还款，乙方有义务无条件及时配合丙方工作；<br/>
									</p>
									<p>
										第三条 丙方权利与义务<br/>
										1） 丙方接受乙方的委托后，须为乙方提供约定的全程信息技术服务，及在过程中协助其办理各项手续；<br/>
										2） 丙方有权以互联网信用评分为目的使用乙方个人信用信息，并提供给丙方指定合作方；<br/>
										3） 对于乙方提供给丙方的个人信息及其他各类授权，丙方有义务在本协议约定下为乙方保密（但第八条约定的情形除外）；<br/>
										4） 丙方有权通过乙方提供的个人信用信息、授权及资料进行审核，根据乙方需要可以为乙方提供上述服务内容的相关建议；<br/>
										5） 丙方有权根据丙方对乙方的评测结果决定是否进一步提供服务；<br/>
									</p>
									<p>
										第四条 特殊约定<br/>
										1） 因乙方未按和资金提供方的双方合同约定及时还款而产生的逾期罚息、逾期管理服务费和催收等涉及资金提供方、丙方、律师等第三方机构所有费用全部由乙方承担。<br/>
										2） 如乙方出现严重违约行为，而被资金提供方要求解除合同时，乙方除按照约定向资金提供方支付违约金外，需要另行向丙方承担违约责任。<br/>
									</p>
									<p>
										第五条 违约责任<br/>
										任何一方违反本协议的约定，使得本协议的全部或部分不能履行，均应向对方支付违约金，并且如果违约金低于对方遭受的损失，还应赔偿对方超过违约金部分的损失（包括由此产生的诉讼费和律师费等其他费用）；如双方均违约，根据实际情况各自承担相应的责任。违约金为乙方与资金提供方达成协议的全额本息资金的20%,乙方授权丙方保留将乙方违约失信的相关信息在媒体披露的权利。
									</p>
									<p>
										第六条 其他<br/>
										1.本协议采用电子文本形式制成，并永久保存在丙方为此设立的专用服务器上备查，各方均认可该形式的协议效力。<br/>
										2.本协议自文本最终生成之日生效。<br/>
										3.如果本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。<br/><br/>
									</p>
								</p>
								<!-- <a href="#" class="agree">同 意</a> -->
							</div>
						</div>
					</div>
				</div>
		</div>


	</div>
    <script type="text/javascript" src="js/widgets/bankLists.js?<?php echo $v; ?>"></script>
    <script type="text/javascript" src="js/widgets/constants.js?<?php echo $v; ?>"></script>
    <script type="text/javascript" src="js/libs/zepto.js?<?php echo $v; ?>"></script>
    <script type="text/javascript" src="js/widgets/pb.js?<?php echo $v; ?>"></script>
    <script type="text/javascript" src="js/widgets/tools.js?<?php echo $v; ?>"></script>
    <script type="text/javascript" src="js/widgets/MessageBox.js?<?php echo $v; ?>"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		 $("#container").PUB();
		 wx.config(<?php echo $js->config(array('hideOptionMenu'), false, true) ?>);
		 wx.ready(function(){
		 	wx.hideOptionMenu();
		 });

	</script>	
</body>
</html>
