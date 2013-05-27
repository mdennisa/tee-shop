<?php
require_once 'session.php';
require_once 'config.php';
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
			$('.product').hover(
				function(){
					$(this).find('.price').fadeIn();
				},
				function(){
					$(this).find('.price').fadeOut();
				}
			);
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
			$st = $db->prepare("SELECT * FROM product");
			$st->execute();
			while($r = $st->fetchObject()) {
		?>
		<div class="product">
			<a href="product/<?=$r->ID?>"><img src="<?=base_url?>images/<?=$r->img?>" alt="<?=$r->name?>" /></a>
			<div class="price">
				<span class="blue">$</span> <?=number_format($r->price, 2, '.', '')?>
			</div>
		</div><!-- product -->
		<?php
			} //end while
		?>

		<div class="clear"></div>
	</div><!--content-->
</div><!--wrapper-->
<?php include('footer.php'); ?>