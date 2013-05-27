<?php
session_start();
require_once '../config.php';
require_once 'session_admin.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=title?></title>
	<link rel="stylesheet" href="<?=base_url?>css/base.css" type="text/css" />
	<script type="text/javascript" src="/jquery/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="<?=base_url?>code/cufon-yui.js"></script>
	<script type="text/javascript" src="<?=base_url?>code/Qlassik_Medium_500.font.js"></script>
	<script type="text/javascript">
		//<![CDATA[
		$(document).ready(function(){

		});
		Cufon.replace('h1');
		//]]>
	</script>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h1 class="logo"><?=title?></h1>
	</div><!--header-->
	<?php include('nav.php'); ?>
	<div id="content">
		<fieldset class="info">
			<div class="desc">
				<strong>PURCHASE ORDER</strong>
			</div>
			<?php
				$st = $db->prepare("SELECT * FROM purchase_order");
				$st->execute();
				while($r = $st->fetchObject()) {
			?>
			<div class="separator"></div>
			<p>
				Name : <span class="blue"><?=$r->name?></span><br />
				Email : <span class="blue"><?=$r->email?></span><br />
				Payment Option : <span class="blue"><?=$r->payment_option?></span><br />
				Payment : <span class="gray">$</span> <span class="blue"><?=$r->total?></span><br />
				Status : <span class="red"><?=$r->status?></span><br />
			</p>
			<p>
				Code : <span class="gray"><?=$r->cart_id?></span><br />
			</p>
			<p><a href="purchase_details.php?id=<?=$r->ID?>" class="btn">details</a></p>
			<?php
				}
			?>
		</fieldset>
	</div><!--content-->
</div><!--wrapper-->
<?php include('../footer.php'); ?>