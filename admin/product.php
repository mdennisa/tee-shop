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
			$('.delete').click(function() {
				var title = $(this).attr('title');
				var x = confirm('Are you sure want to delete "'+title+'" ?')
				if(x) {
					location.href = $(this).attr('href');
				}
				return false;
			});
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
				<strong>PRODUCT LIST</strong>
			</div>
			<div class="separator"></div>
			<p>
				<a href="product_add.php" class="btn add-to-cart">add product</a>
			<?php
				$get = $_GET;
				if(! empty ($get['log'])) {
			?>
				<span class="btn blue">Product <?=$get['log']?> !</span>
			<?php
				}
			?>
			</p>
			<?php
				$st = $db->prepare("SELECT * FROM product");
				$st->execute();
				while($r = $st->fetchObject()) {
			?>
			<div class="separator"></div>
			<p>
				<a href="product_update.php?id=<?=$r->ID?>"><img src="<?=base_url?>images/<?=$r->img?>" width="100" class="pic" /></a><br />
				Name : <a href="product_update.php?id=<?=$r->ID?>"><?=$r->name?></a><br />
				Price : <span class="gray">$</span> <span class="blue"><?=$r->price?></span><br />
				Stock : <span class="blue"><?=$r->stock?></span><br />
				Hit : <span class="red"><?=$r->hit?></span>
			</p>
			<p><a href="product_delete.php?id=<?=$r->ID?>" title="<?=$r->name?>" class="btn red delete">delete</a></p>
			<?php
				}
			?>
		</fieldset>
	</div><!--content-->
</div><!--wrapper-->
<?php include('../footer.php'); ?>