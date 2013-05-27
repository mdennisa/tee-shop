<?php
require_once 'session.php';
require_once 'config.php';
$get = $_GET;

if( empty($_COOKIE['ID-'.$get['id']]) ) {
	$st = $db->prepare("UPDATE product SET hit=hit+1 WHERE ID=?");
	$st->execute(array($get['id']));
	setcookie('ID-'.$get['id'], 'true', time()+3600);
}

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
	<?php
		$st = $db->prepare("SELECT * FROM product WHERE ID=?");
		$st->execute(array($get['id']));
		$r = $st->fetchObject();
	?>
	<div id="content" class="product-details">
		<div class="img center">
			<img src="<?=base_url?>images/<?=$r->img?>" />
		</div><!-- img -->
		<div class="info">
			<div class="product-name"><?=$r->name?></div><!-- product-name -->
			<div class="separator"></div>
			<div class="desc">
				<?=nl2br($r->info)?>
			</div>
			<div class="separator"></div>
			<div class="price">
				<?=number_format($r->price, 2, '.', '')?>
			</div><!-- price -->
			<div class="separator"></div>
			<?php
				if ($r->stock < 1) {
			?>
			<div class="product-add">
				<span class="btn outofstock">sold out</span>
			</div>
			<div class="separator"></div>
			<div class="desc">
				We are very sorry but this product is not available for the moment.<br />
				We recommend you to look at our other product.
			</div>
			<div class="separator"></div>
			<div class="desc">
				<a href="<?=base_url?>product" class="btn continue-shop">continue shopping</a>
			</div>
			<?php
				} else {
			?>
			<div class="product-add">
				<a href="cart_add/<?=$r->ID?>" class="btn add-to-cart">add to cart</a>
			</div>
			<div class="separator"></div>
			<div class="desc">
				Stock : <span class="blue bold"><?=$r->stock?></span>
			</div>
			<?php
				}
			?>
		</div><!-- info -->
		<div class="clear"></div>
	</div><!--content-->
</div><!--wrapper-->
<?php include('footer.php'); ?>