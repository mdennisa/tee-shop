<?php
require_once 'session.php';
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=title?></title>
	<link rel="stylesheet" href="<?=base_url?>css/base.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url?>code/validationEngine.jquery.css" type="text/css" />
	<script type="text/javascript" src="/jquery/jquery-1.4.2.min.js"></script>
	<script src="<?=base_url?>code/jquery.validationEngine-en.js" type="text/javascript"></script>
	<script src="<?=base_url?>code/jquery.validationEngine.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=base_url?>code/cufon-yui.js"></script>
	<script type="text/javascript" src="<?=base_url?>code/Qlassik_Medium_500.font.js"></script>
	<script type="text/javascript">
		//<![CDATA[
		$(document).ready(function(){
			$('#payment').validationEngine();
		});
		Cufon.replace('h1');
		//]]>
	</script>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h1 class="logo">Tee-shop</h1>
	</div><!--header-->
	<?php include('nav.php'); ?>
	<div id="content">
		<form method="post" action="payment_exec.php" id="payment">
			<fieldset class="info">
				
				<div class="desc">
				<select name="payment_option">
					<option value="cash on delivery">Cash on Delivery</option>
					<option value="paypal">Paypal</option>
				</select>
				</div>
				<div class="separator"></div>
				<div class="desc">
					Name <input type="text" name="name" id="name" class="validate[required]" />
				</div>
				<div class="separator"></div>
				<div class="desc">
					Phone <input type="text" name="phone" id="phone" class="validate[required]" />
					Email <input type="text" name="email" id="email" class="validate[required]" />
				</div>
				<div class="separator"></div>
				<div class="desc">
					Address<br />
					<textarea name="address" id="address" class="validate[required]"></textarea>
				</div>
				<div class="separator"></div>
				<input type="hidden" name="total" value="<?=$_SESSION['cart_id']?>" />
				<input type="hidden" name="total" value="<?=$_SESSION['subtotal']?>" />
				<input type="submit" value="Submit" class="btn" />
				
			</fieldset>
		</form>
	</div><!--content-->
</div><!--wrapper-->
<?php include('footer.php'); ?>