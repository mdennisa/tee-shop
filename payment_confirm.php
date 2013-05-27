<?php
require_once 'session.php';
require_once 'config.php';

unset($_SESSION['cart']);
unset($_SESSION['subtotal']);
unset($_SESSION['items']);

if ( empty($_SESSION['cart_insert-id']) ) {
	header('location:'. base_url);
}

$cart_insert_id = $_SESSION['cart_insert-id'];
$cart_id = $_COOKIE['cart_id'];

setcookie('cart_id', '', time()-3600);
unset($_SESSION['cart_insert-id']);
unset($_SESSION['cart_id']);
session_regenerate_id();

//print_r($_SESSION);
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
	<?php
		$st = $db->prepare("SELECT * FROM purchase_order WHERE cart_id=?");
		$st->execute(array($cart_id));
		$r = $st->fetchObject();
	?>
			<fieldset class="info">
				<legend>information</legend>
				<div class="desc">
					Purchase code : <span class="blue"><?=$r->cart_id?></span>
				</div>
				<div class="separator"></div>
				<div class="desc">
					Payment : <span class="blue bold"><?=$r->payment_option?></span>
				</div>
				<div class="separator"></div>
				<div class="desc">
					Name : <span class="blue"><?=$r->name?></span>
				</div>
				<div class="separator"></div>
				<div class="desc">
					Phone : <span class="blue"><?=$r->phone?></span><br />
					Email : <span class="blue"><?=$r->email?></span>
				</div>
				<div class="separator"></div>
				<div class="desc">
					Address :
					<div class="blue">
						<?=nl2br($r->address)?>
					</div>
				</div>
				<div class="separator"></div>
				<?php
					$st = $db->prepare("SELECT purchase_item.*, product.* FROM purchase_item LEFT JOIN product ON purchase_item.product_ID=product.ID WHERE cart_id=?");
					$st->execute(array($cart_insert_id));
					while( $p = $st->fetchObject() ) {
				?>
				<div class="desc">
					<span class="fl"><?=$p->name?> x <?=$p->qty?></span>
					<span class="fr blue"><span class="gray">$</span> <?=$p->price*$p->qty?></span>
					<div class="clear"></div>
				</div>
				<div class="separator"></div>
				<?php
					}
				?>
				<div class="desc">
					<span class="fl">Total Payment : </span>
					<span class="fr blue bold"><span class="gray">$</span> <?=$r->total?></span>
					<div class="clear"></div>
				</div>
				<div class="separator"></div>
				<a href="<?=base_url?>product" class="btn continue-shop">continue shopping</a>
			</fieldset>
			
	</div><!--content-->
</div><!--wrapper-->
<?php include('footer.php'); ?>